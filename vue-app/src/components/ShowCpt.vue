<!-- Si vous souhaitez customiser l'app, copiez tous le dossier de l'app ainsi que le block acf associé 
dans le thème enfant, et redéclarez un bloc avec l'app copiée -->

<script>
import FiltersCpts from "./FiltersCpts.vue";
import ExtraitDefaut from "./excerpts/ExtraitDefaut.vue";
import WebinaireExcerpt from "./excerpts/WebinaireExcerpt.vue";
import CasClient from "./excerpts/CasClient.vue";
import ExtraitActualite from "./excerpts/ExtraitActualite.vue";
import ExtraitFormation from "./excerpts/ExtraitFormation.vue";
import he from "he";
import { getApiData } from "../helpers/getApi";
import { cleanUrl } from "../helpers/cleanUrl";
import dataProperties from "../helpers/dataProperties";

export default {
  name: "ShowCpt",
  components: {
    FiltersCpts,
    ExtraitDefaut,
    WebinaireExcerpt,
    CasClient,
    ExtraitActualite,
    ExtraitFormation,
  },
  data() {
    return {
      ...dataProperties(),
      dataJson: {},
    };
  },

  mounted() {


    this.app = document.querySelector("#app");

    const taxoInExcerptAttribute = [
      "taxo-1-extrait",
      "taxo-2-extrait",
      "taxo-3-extrait",
      "taxo-4-extrait",
    ];

    for (let i = 0; i < taxoInExcerptAttribute.length; i++) {
      const taxoInExcerpt = this.app.getAttribute(taxoInExcerptAttribute[i]);
      if (taxoInExcerpt !== null) {
        this.taxonomiesToShow.push(taxoInExcerpt);
      }
    }
    this.dataJson = JSON.parse(this.app.getAttribute("data-json"));
    this.setMaxDisplayablePosts(this.dataJson.max_posts);
    this.setIncrementNumber(this.dataJson.increment_number);
    this.getCpt(this.dataJson.publication_liste_app_child).then(() => {
      this.activeAllAtStart();
    });
  },
  updated() {
    this.decodeHtmlInTree(this.app);
  },
  methods: {
    activeAllAtStart() {
      this.cpts.forEach((cpt) => {
        cpt.show = true;
        this.displayPostAccordingMaxDisplayable(cpt);
      });
      this.filters.forEach((filter) => {
        filter.isAllButtonToggled = true;
        filter.terms.forEach((term) => {
          term.active = false;
        });
      });
      this.hasMoreContent = this.displayed < this.displayablePosts;
      this.recordOriginalCpts();
    },
    convertToFrenchDate(dateString) {
      if (dateString) {
        var date = new Date(
          dateString.slice(0, 4),
          dateString.slice(4, 6) - 1,
          dateString.slice(6)
        );
        var options = { year: "numeric", month: "short", day: "numeric" };
        return new Intl.DateTimeFormat("fr-FR", options).format(date);
      }
    },
    async getCpt(cptName) {
      const { website, protocol } = cleanUrl(this.website, this.protocol); // récupère le bon nom de site et le bon protocole
      this.website = website;
      this.protocol = protocol;
      this.cptName = cptName;

      let cptNameForRequest = this.cptName;

      // attention ici en cas d'usage des posts, le nom est différent entre la route et le nom en PHP...
      if (this.cptName === "post") {
        cptNameForRequest = "posts";
      }

      try {
        this.cpts = await getApiData(
          `${this.protocol}://${this.website}/wp-json/wp/v2/${cptNameForRequest}?per_page=100&_embed`
        );

        this.cpts = this.reorganiseCpts(this.cpts);

        //on récupère les taxonomies et les terms
        this.taxonomiesAndTerms = await getApiData(
          `${this.protocol}://${this.website}/wp-json/wp/v2/taxonomies-and-terms/`
        );

        // on charge le contenu des filtres
        this.filters = this.loadFiltersContent(
          this.taxonomiesAndTerms,
          this.cptName
        );
        this.isLoaded = true;
      } catch (err) {
        console.log(err);
      }
      // si this.cpts.length est égal à 100, il faut refaire une requête pour récupérer les 100 suivants
    },
    loadFiltersContent(taxonomiesAndTerms, cptName) {
      let filters = [];
      let i = 1;
      for (i = 1; i < 5; i++) {
        let filter = this.dataJson["filtre_etage_" + i];
        filter ? filters.push(filter) : null;
      }
      return filters.map((filter) => {
        if (taxonomiesAndTerms[cptName][filter]) {
          return {
            taxonomy: filter,
            terms: taxonomiesAndTerms[cptName][filter],
            isAllButtonToggled: false,
          };
        }
      });
    },
    reorganiseCpts(cpts) {
      return (cpts = cpts.map((cpt) => {
        let newCpt = { ...cpt, show: true };
        if ("_embedded" in newCpt) {
          newCpt.terms = newCpt._embedded["wp:term"]
            ? newCpt._embedded["wp:term"].flatMap((taxo) => taxo)
            : "";
        } else {
          newCpt.terms = [];
        }
        return newCpt;
      }));
    },
    decodeHtmlInTree(node) {
      const nodes = node.childNodes;
      for (let i = 0; i < nodes.length; i++) {
        const currentNode = nodes[i];
        if (currentNode.nodeType === Node.TEXT_NODE) {
          currentNode.textContent = currentNode.textContent
            ? he.decode(currentNode.textContent)
            : "";
        } else if (currentNode.nodeType === Node.ELEMENT_NODE) {
          this.decodeHtmlInTree(currentNode);
        }
      }
    },
    displayPostAccordingMaxDisplayable(cpt) {
      // console.log("montre les CPT selon le max possible");
      this.displayablePosts++;
      if (this.displayed < this.maxDisplayable) {
        cpt.display = true;
        this.displayed++;
      } else {
        cpt.display = false;
      }
    },
    handleClick(termName, filter) {
      console.log("gestion du clic des boutons");
      if (this.originalCpts.length === 0) {
        this.recordOriginalCpts();
      } else {
        if (
          this.originalCpts.length > 0 &&
          this.originalCpts.length !== this.cpts.length
        ) {
          this.cpts = JSON.parse(JSON.stringify(this.originalCpts));
        }
      }
      console.log("Clic sur un filtre");
      this.filters = this.filters.map((innerFilter) => {
        if (termName === "all") {
          if (innerFilter.taxonomy === filter.taxonomy) {
            return this.toggleAllToTrueInFilter(innerFilter);
          } else {
            return innerFilter;
          }
        } else {
          let termsCopy = this.toggleTermClicked(termName, innerFilter);
          let isAllButtonToggled = this.checkIfAnyTermActive(termsCopy);

          return {
            ...innerFilter, // On copie toutes les propriétés de 'filter'
            terms: termsCopy, // On utilise la copie modifiée des termes
            isAllButtonToggled: isAllButtonToggled, // On met à jour la valeur de 'isAllButtonToggled'
          };
        }
      });
      this.filterCpts(filter);
      this.hasMoreContent = this.displayed < this.displayablePosts;
    },
    toggleTermClicked(termName, innerFilter) {
      let termsCopy = innerFilter.terms.map((term) => {
        let termCopy = { ...term }; // Copie de l'objet 'term'
        if (termCopy.name === termName) {
          termCopy.active = !termCopy.active;
        }
        return termCopy;
      });
      return termsCopy;
    },
    checkIfAnyTermActive(termsCopy) {
      let activeTermFound = termsCopy.find((term) => term.active);
      let isAllButtonToggled = activeTermFound === undefined ? true : false;
      return isAllButtonToggled;
    },
    incrementmaxDisplayable() {
      this.maxDisplayable = this.maxDisplayable + this.incrementNumber;
      this.displayed = 0;
      this.cpts.forEach((cpt) => {
        if (this.displayed < this.maxDisplayable) {
          if (cpt.show) {
            cpt.display = true;
            this.displayed++;
          }
        }
      });

      this.hasMoreContent = this.displayed < this.displayablePosts;
    },
    toggleAllToTrueInFilter(innerFilter) {
      let termsCopy = innerFilter.terms.map((term) => {
        let termCopy = { ...term }; // Copie de l'objet 'term'
        termCopy.active = false;
        return termCopy;
      });
      let isAllButtonToggled = true;
      return {
        ...innerFilter, // On copie toutes les propriétés de 'filter'
        terms: termsCopy, // On utilise la copie modifiée des termes
        isAllButtonToggled: isAllButtonToggled, // On met à jour la valeur de 'isAllButtonToggled'
      };
    },
    recordOriginalCpts() {
      // console.log("enregistrement des CPTS originaux");
      this.originalCpts = JSON.parse(JSON.stringify(this.cpts));
    },
    setMaxDisplayablePosts(value) {
      this.maxDisplayable = parseInt(value);
    },
    setIncrementNumber(value) {
      this.incrementNumber = parseInt(value);
    },
    userSearchOrDeleteKeyword(keyword) {
      this.lastKeyword = keyword;
      // Si le mot-clé est vide (l'utilisateur a effacé son mot-clé), on réinitialise la liste des CPTs et on sort de la fonction
      // Si le mot-clé est de longueur 1 (quand l'utilisateur a commencé à entrer une valeur),
      // on supprime du tableau des CPT ceux qui ne sont pas visibles, dans le but de pouvoir revenir à l'état
      // du premier filtre
      this.displayed = 0;
      this.displayablePosts = 0;
      this.cpts.forEach((cpt) => {
        const title = cpt.title.rendered.toLowerCase();

        const checkMatch = (input) =>
          he.decode(input.toLowerCase()).includes(keyword.toLowerCase());

        const checkAcfFields = (acf) => {
          for (const key in acf) {
            if (
              acf[key] &&
              typeof acf[key] === "string" &&
              checkMatch(acf[key])
            ) {
              return true;
            }
          }
          return false;
        };

        const checkTerms = (terms) => {
          for (const key in terms) {
            if (checkMatch(terms[key].name)) {
              return true;
            }
          }
          return false;
        };

        let match =
          checkMatch(title) ||
          checkAcfFields(cpt.acf) ||
          (cpt.terms.length > 0 && checkTerms(cpt.terms));
        cpt.display = match && cpt.show && cpt.display;

        if (cpt.display) {
          this.displayablePosts++;
          if (this.displayed < this.maxDisplayable) {
            this.displayed++;
          } else {
            cpt.display = false;
          }
        }
      });

      this.hasMoreContent = this.displayed < this.displayablePosts;
    },
    filterElementsByKeyword(keyword) {
      this.displayed = 0;
      this.displayablePosts = 0;
      console.log("filtre par mots clés : ", keyword);
      if (this.lastKeyword.length < keyword.length) {
        console.log("lutilisateur affine");
        this.userSearchOrDeleteKeyword(keyword);
      } else {
        console.log("lutilisateur efface");
        this.lastKeyword = keyword;
        if (keyword === "") {
          console.log("le champ est de nouveau vide");
          if (this.activeTerms.length > 0) {
            this.cpts = JSON.parse(JSON.stringify(this.filteredCpts));
          } else {
            this.cpts = JSON.parse(JSON.stringify(this.originalCpts));
          }

          this.cpts.forEach((cpt) => {
            if (cpt.show) {
              this.displayPostAccordingMaxDisplayable(cpt);
            }
          });

          this.hasMoreContent = this.displayed < this.displayablePosts;
          return;
        } else {
          console.log("l'utilisateur efface mais le champ n'est pas vide");
          this.userSearchOrDeleteKeyword(keyword);
        }
      }
    },
    filterCpts(filter) {
      this.displayablePosts = 0;
      this.displayed = 0;
      this.cpts.forEach((cpt) => {
        const taxonomyFiltered = filter.taxonomy;
        let termPresentInFilter;
        let isAllButtonToggledInFilter;
        let isAllButtonToggledInOtherFilter;
        let termPresentInOtherFilter;
        this.filters.forEach((innerFilter) => {
          if (innerFilter.taxonomy === taxonomyFiltered) {
            isAllButtonToggledInFilter = innerFilter.isAllButtonToggled;
            termPresentInFilter = innerFilter.terms.find(
              (term) => term.term_id === cpt[innerFilter.taxonomy][0]
            );
          } else {
            isAllButtonToggledInOtherFilter = innerFilter.isAllButtonToggled;
            termPresentInOtherFilter = innerFilter.terms.find(
              (term) => term.term_id === cpt[innerFilter.taxonomy][0]
            );
          }
        });
        if (
          isAllButtonToggledInFilter ||
          (termPresentInFilter.active && isAllButtonToggledInOtherFilter) ||
          (termPresentInFilter.active && termPresentInOtherFilter.active)
        ) {
          cpt.show = true;
          this.displayPostAccordingMaxDisplayable(cpt);
        } else {
          cpt.show = false;
        }
        this.hasMoreContent = this.displayed < this.displayablePosts;
        this.recordFilteredCpts();
      });
    },
    recordFilteredCpts() {
      this.filteredCpts = JSON.parse(JSON.stringify(this.cpts));
    },
  },
};
</script>

<template>
  <FiltersCpts
  v-show="isLoaded"
    @handleClick="handleClick"
    @filterElementsByKeyword="filterElementsByKeyword"
    :filters="filters"
    :champs_texte_pour_affiner="dataJson.champs_texte_pour_affiner"
    :type_de_filtre="dataJson.type_de_filtre"
    :texte_pour_le_label_1="dataJson.texte_pour_le_label_1"
    :texte_pour_le_label_2="dataJson.texte_pour_le_label_2"
    :texte_pour_le_label_3="dataJson.texte_pour_le_label_3"
    :texte_pour_le_label_4="dataJson.texte_pour_le_label_4"
    :texte_tous_les_filtres_1="dataJson.texte_tous_les_filtres_1"
    :texte_tous_les_filtres_2="dataJson.texte_tous_les_filtres_2"
    :texte_tous_les_filtres_3="dataJson.texte_tous_les_filtres_3"
    :texte_tous_les_filtres_4="dataJson.texte_tous_les_filtres_4"
  />
  <div v-show="isLoaded" :class="'extraits-container ' + extraitPaddingTop">
    <template v-if="cptName === 'webinaire'">
      <div class="results">
        <WebinaireExcerpt
          v-show="cpt.show && cpt.display"
          class="cpt-extrait"
          v-for="cpt in cpts"
          :key="cpt.id"
          :cpt="cpt"
          :date_de_fin_de_candidature_texte="date_de_fin_de_candidature_texte"
          :afficher_le_bouton_lie_a_la_fiche_de_poste="
            afficher_le_bouton_lie_a_la_fiche_de_poste
          "
          :texte_en_savoir_plus="texte_en_savoir_plus"
          :texte_bouton_fiche_de_poste="texte_bouton_fiche_de_poste"
        />
      </div>
      <div
        @click="incrementmaxDisplayable"
        v-if="hasMoreContent"
        class="load-more"
      >
        {{ dataJson.load_more_text }}
      </div>
    </template>
    <template v-else-if="cptName === 'client'">
      <div class="results">
        <CasClient
          v-show="cpt.show && cpt.display"
          class="cpt-extrait"
          v-for="cpt in cpts"
          :key="cpt.id"
          :cpt="cpt"
          :date_de_fin_de_candidature_texte="
            dataJson.date_de_fin_de_candidature_texte
          "
          :afficher_le_bouton_lie_a_la_fiche_de_poste="
            dataJson.afficher_le_bouton_lie_a_la_fiche_de_poste
          "
          :texte_en_savoir_plus="dataJson.texte_en_savoir_plus"
          :texte_bouton_fiche_de_poste="dataJson.texte_bouton_fiche_de_poste"
          :texte_bouton_video="dataJson.texte_bouton_video"
        />
      </div>
      <div
        @click="incrementmaxDisplayable"
        v-if="hasMoreContent"
        class="load-more"
      >
        {{ dataJson.load_more_text }}
      </div>
    </template>
    <template v-else-if="cptName === 'post'">
      <div class="results">
        <ExtraitActualite
          v-show="cpt.show && cpt.display"
          class="cpt-extrait"
          v-for="cpt in cpts"
          :key="cpt.id"
          :cpt="cpt"
          :date_de_fin_de_candidature_texte="
            dataJson.date_de_fin_de_candidature_texte
          "
          :afficher_le_bouton_lie_a_la_fiche_de_poste="
            dataJson.afficher_le_bouton_lie_a_la_fiche_de_poste
          "
          :texte_en_savoir_plus="dataJson.texte_en_savoir_plus"
          :texte_bouton_fiche_de_poste="dataJson.texte_bouton_fiche_de_poste"
        />
      </div>
      <div
        @click="incrementmaxDisplayable"
        v-if="hasMoreContent"
        class="load-more"
      >
        {{ dataJson.load_more_text }}
      </div>
    </template>
    <template v-else-if="cptName === 'formation'">
      <div class="results">
        <ExtraitFormation
          v-show="cpt.show && cpt.display"
          class="cpt-extrait"
          v-for="cpt in cpts"
          :key="cpt.id"
          :cpt="cpt"
          :date_de_fin_de_candidature_texte="
            dataJson.date_de_fin_de_candidature_texte
          "
          :afficher_le_bouton_lie_a_la_fiche_de_poste="
            dataJson.afficher_le_bouton_lie_a_la_fiche_de_poste
          "
          :texte_en_savoir_plus="dataJson.texte_en_savoir_plus"
          :texte_bouton_fiche_de_poste="dataJson.texte_bouton_fiche_de_poste"
          :taxonomiesToShow="taxonomiesToShow"
          :texte_du_bouton_fiche_formation="
            dataJson.texte_du_bouton_fiche_formation
          "
          :texte_de_la_card_pour_le_champ_duree="
            dataJson.texte_de_la_card_pour_le_champ_duree
          "
          :texte_de_la_card_pour_le_champ_prochaine_session="
            dataJson.texte_de_la_card_pour_le_champ_prochaine_session
          "
        />
      </div>
      <div
        @click="incrementmaxDisplayable"
        v-if="hasMoreContent"
        class="load-more"
      >
        {{ dataJson.load_more_text }}
      </div>
    </template>
    <template v-else>
      <div class="results">
        <ExtraitDefaut
          v-show="cpt.show && cpt.display"
          class="cpt-extrait"
          v-for="cpt in cpts"
          :key="cpt.id"
          :cpt="cpt"
          :date_de_fin_de_candidature_texte="
            dataJson.date_de_fin_de_candidature_texte
          "
          :afficher_le_bouton_lie_a_la_fiche_de_poste="
            dataJson.afficher_le_bouton_lie_a_la_fiche_de_poste
          "
          :texte_en_savoir_plus="dataJson.texte_en_savoir_plus"
          :texte_bouton_fiche_de_poste="dataJson.texte_bouton_fiche_de_poste"
          :taxonomiesToShow="taxonomiesToShow"
        />
      </div>
      <div
        @click="incrementmaxDisplayable"
        v-if="hasMoreContent"
        class="load-more"
      >
        {{ dataJson.load_more_text }}
      </div>
    </template>
  </div>
  <div v-show="!isLoaded" class="loader-container">
    <div class="lds-ripple">
      <div class="1" />
      <div class="2" />
    </div>
  </div>
</template>

<style lang="scss">
.loader-container {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100vh;
}

.lds-ripple {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}

.lds-ripple div {
  position: absolute;
  border: 4px solid rgb(111, 111, 111);
  opacity: 1;
  border-radius: 50%;
  animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
}

.lds-ripple div:nth-child(2) {
  animation-delay: -0.5s;
}

@keyframes lds-ripple {
  0% {
    top: 36px;
    left: 36px;
    width: 0;
    height: 0;
    opacity: 0;
  }

  4.9% {
    top: 36px;
    left: 36px;
    width: 0;
    height: 0;
    opacity: 0;
  }

  5% {
    top: 36px;
    left: 36px;
    width: 0;
    height: 0;
    opacity: 1;
  }

  100% {
    top: 0px;
    left: 0px;
    width: 72px;
    height: 72px;
    opacity: 0;
  }
}

// le code scss se trouve dans le thème enfant

// décommenter ce code uniquemet dans le contexte de npm run dev / npm run serve
/* 
#block-app {
  .evenements {
    display: flex;
    flex-direction: column;
    width: 100%;
    .a-venir {
      width: 100%;
    }
    .passe {
      width: 100%;
    }
  }
  .text-filter-container {
    position: relative;
    svg {
      position: absolute;
      left: 0.8rem;
      width: 1rem;
      fill: black;
      z-index: 1;
      bottom: 32%;
    }
  }
  #app {
    background-color: black;
    min-width: 1000px;
  }
  .results {
    display: grid;
    grid-template-columns: repeat(auto-fill, 32%);
    grid-gap: 1rem;
    margin-top: 1rem;
  }
  .filter-input {
    width: 50%;
    padding: 0.5rem 1rem 0.5rem 2rem;
    border-radius: 1.5rem !important;
    margin-top: 1rem;
    margin-bottom: 1rem;
    color: black;
  }
  .filters {
    display: flex;
    flex-direction: column;
    .buttons {
      display: flex;
      flex-direction: row;
      .button {
        margin-right: 1rem;
        cursor: pointer;
        display: flex;
        background: white;
        color: #c90045;
        padding: 0.3rem 1.5rem;
        border-radius: 1.5rem;
      }
      .active {
        background-color: #c90045;
        color: white;
      }
    }
  }
  .cpt-extrait {
    width: 100%;
    padding-top: 3rem;
    position: relative;
    background-color: white;
    padding: 3rem 1rem 1rem 2rem;

    .employeur {
      color: #c90045;
    }
    h2 {
      font-weight: bold;
    }
    h2,
    p {
      text-align: center;
    }
    .desc-page {
      text-align: left;
    }
    .term {
      position: absolute;
      top: 1rem;
      left: 0;
      background-color: #c90045;
      color: white;
      padding: 0rem 1rem 0rem 0.5rem;
    }
    .buttons-extrait {
      display: flex;
      flex-direction: row;
    }
  }
  .load-more {
    cursor: pointer;
    padding: 1rem;
    background-color: black;
    color: white;
    max-width: 15rem;
  }
  select {
    width: 25%;
    padding: 0.5rem;
  }
  .selects-container {
    margin-bottom: 1rem;
  }

  .cpt-extrait {
    margin-bottom: 1rem;
  }

  h1 {
    font-weight: 500;
    font-size: 2.6rem;
    top: -10px;
  }

  h3 {
    font-size: 1.2rem;
  }
} */
</style>
