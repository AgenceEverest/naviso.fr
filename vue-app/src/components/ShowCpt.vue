<!-- Si vous souhaitez customiser l'app, copiez tous le dossier de l'app ainsi que le block acf associé 
dans le thème enfant, et redéclarez un bloc avec l'app copiée -->

<script>
import FiltersCpts from "./FiltersCpts.vue";
import OffreEmploi from "./excerpts/OffreEmploi.vue";
import WebinaireExcerpt from "./excerpts/WebinaireExcerpt.vue";
import he from "he";
import { getApiData } from "../utils/getApi";
export default {
  name: "ShowCpt",
  components: {
    FiltersCpts,
    OffreEmploi,
    WebinaireExcerpt,
  },
  data() {
    return {
      app: HTMLElement,
      activeTerms: [],
      afficherBoutonTelechargement: false,
      afficherBoutonFicheDePoste: false,
      cpt: "",
      cpts: [],
      cptName: "",
      displayablePosts: 0, // correspond au nombre de posts qui ont show = true et toCome = true
      displayed: 0,
      selected: "",
      filters: [],
      filterType: "",
      taxonomiesAndTerms: [],
      indexCptShow: 0,
      incrementNumber: 0,
      isLoaded: false,
      texteFinCandidature: "",
      texteBoutonTelecharger: "",
      hasMoreContent: true,
      howManyTaxonomiesInExcerpt: 0,
      extraitPaddingTop: "extrait-padding-top-1",
      maxDisplayable: 0,
      searchInput: false,
      protocol: "",
      perPage: 0,
      postsFilteredByKeyword: false,
      postsFoundByKeyword: 0,
      lastKeyword: "",
      loadMore: "",
      loadMoreText: "",
      showTaxonomies: {
        1: false,
        2: false,
        3: false,
        4: false,
      },
      texteEventsAVenir: "",
      texteEventsPasses: "",
      texteTouslesFiltres1: "",
      texteTouslesFiltres2: "",
      texteTouslesFiltres3: "",
      texteTouslesFiltres4: "",
      texteDateDeLappelaProjet: "",
      texteDateDeLevenement: "",
      website: "",
    };
  },
  mounted() {
    this.app = document.querySelector("#app");
    this.cpt = this.app.getAttribute("cpt");
    this.texteDateDeLappelaProjet = this.app.getAttribute(
      "texte-date-de-lappel-a-projet"
    );
    this.texteDateDeLevenement = this.app.getAttribute(
      "texte-date-de-levenement"
    );
    this.filterType = this.app.getAttribute("filtre");
    this.searchInput = this.app.getAttribute("champ-recherche");
    this.searchInput = this.searchInput === "1" ? true : false;
    this.setMaxDisplayablePosts(this.app.getAttribute("max-posts"));
    this.setIncrementNumber(this.app.getAttribute("increment-number"));
    this.texteFinCandidature = this.app.getAttribute("texte-fin-candidature");
    this.texteEnSavoirPlus = this.app.getAttribute("texte-en-savoir-plus");
    this.textH2EventAVenir = this.app.getAttribute("text-h2-event-a-venir");
    this.textH2EventPasse = this.app.getAttribute("text-h2-event-passe");
    this.afficherBoutonFicheDePoste = this.app.getAttribute(
      "afficher-bouton-fiche-de-poste"
    );
    this.texteBoutonFicheDePoste = this.app.getAttribute(
      "texte-bouton-fiche-de-poste"
    );
    this.texteEventsAVenir = this.app.getAttribute("texte-evenements-a-venir");
    this.texteEventsPasses = this.app.getAttribute("texte-evenements-passes");

    this.texteBoutonTelecharger = this.app.getAttribute(
      "texte-bouton-de-telechargement"
    );
    this.afficherBoutonTelechargement = this.app.getAttribute(
      "afficher-bouton-telechargement"
    );
    const taxoInExcerptAttribute = [
      "taxo-1-extrait",
      "taxo-2-extrait",
      "taxo-3-extrait",
      "taxo-4-extrait",
    ];

    this.texteTouslesFiltres1 = this.app.getAttribute(
      "texte-tous-les-filtres-1"
    );

    this.texteTouslesFiltres2 = this.app.getAttribute(
      "texte-tous-les-filtres-2"
    );
    this.texteTouslesFiltres3 = this.app.getAttribute(
      "texte-tous-les-filtres-3"
    );
    this.texteTouslesFiltres4 = this.app.getAttribute(
      "texte-tous-les-filtres-4"
    );

    for (let i = 0; i < taxoInExcerptAttribute.length; i++) {
      const taxoInExcerpt = this.app.getAttribute(taxoInExcerptAttribute[i]);
      if (taxoInExcerpt === "1") {
        this.howManyTaxonomiesInExcerpt++;
        this.showTaxonomies[`${i + 1}`] = true;
      }
    }

    this.extraitPaddingTop =
      "extrait-padding-top-" + this.howManyTaxonomiesInExcerpt;

    this.loadMoreText = this.app.getAttribute("load-more-text");

    let i = 1;
    const filters = [];
    for (i = 1; i < 5; i++) {
      let filter = this.app.getAttribute("filtre-etage-" + i);
      filter ? filters.push(filter) : null;
    }

    this.storeFilters(filters);
    //  this.getCpt(this.cpt);
    this.getCpt(this.cpt).then(() => {
      // la première option est sélectionnée par défaut dans le select, mais il faut aussi l'activer dans le store
      if (this.filterType === "select") {
        this.setFirstOptionAsActive();
      } else {
        this.activeAllAtStart();
      }

      /*       // permet de cacher ou d'afficher le bouton pour charger plus de résultats
      this.checkIfMaxPostsIsReached(); */
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
      });
      this.hasMoreContent = this.displayed < this.displayablePosts;
      this.recordOriginalCpts();
    },
    cleanUrl() {
      console.log("lurl est cleanée");
      if (location.hostname === "localhost") {
        let pathname = location.pathname;
        if (location.pathname === "/") {
          // dans le cas d'un localhost avec la commande NPM run dev
          pathname = "/grabuge";
        }
        pathname = pathname.split("/");
        pathname = pathname[1];
        this.website = `localhost/${pathname}`;
        this.protocol = "http";
      } else {
        this.website = location.host;
        this.protocol = "https";
      }
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
      console.log("récupération des CPTS");
      this.cleanUrl();
      this.cptName = cptName;
      try {
        console.log(
          `${this.protocol}://${this.website}/wp-json/wp/v2/${cptName}?per_page=100&_embed`
        );
        this.cpts = await getApiData(
          `${this.protocol}://${this.website}/wp-json/wp/v2/${cptName}?per_page=100&_embed`
        );
        console.log(this.cpts);
        this.cpts.forEach(async (cpt) => {
          cpt.show = true;
          if ("_embedded" in cpt) {
            cpt.terms = cpt._embedded["wp:term"]
              ? cpt._embedded["wp:term"].flatMap((taxo) => taxo)
              : "";
          } else {
            cpt.terms = [];
          }
          cpt.toCome = true; // on le met par défaut sur tous les CPT pour faciliter le codes
          if (cpt.acf.date_de_levenement) {
            if (cpt.acf.date_de_levenement) {
              const year = cpt.acf.date_de_levenement.slice(0, 4);
              const month = cpt.acf.date_de_levenement.slice(4, 6) - 1; // Les mois commencent à 0
              const day = cpt.acf.date_de_levenement.slice(6, 8);
              const eventDate = new Date(year, month, day);
              const now = new Date();
              if (eventDate < now) {
                cpt.toCome = false; // L'événement est déjà passé
              }
              if (cpt.acf.date_de_levenement) {
                cpt.acf.date_de_levenement = this.convertToFrenchDate(
                  cpt.acf.date_de_levenement
                );
              }
            }
          }
          if (cpt.acf.fichier_a_telecharger) {
            const fileObject = await getApiData(
              `${this.protocol}://${this.website}/wp-json/wp/v2/media/${cpt.acf.fichier_a_telecharger}`
            );
            cpt.acf.fichier_a_telecharger = fileObject.source_url;
          }
        });
        //on récupère les taxonomies et les terms
        const taxonomiesAndTerms = await getApiData(
          `${this.protocol}://${this.website}/wp-json/wp/v2/taxonomies-and-terms/`
        );
        this.taxonomiesAndTerms = taxonomiesAndTerms;
        this.filters = this.filters.map((filter) => {
          if (this.taxonomiesAndTerms[this.cptName][filter]) {
            return {
              taxonomy: filter,
              terms: this.taxonomiesAndTerms[this.cptName][filter],
              isAllButtonToggled: false,
            };
          }
        });
        this.isLoaded = true;
      } catch (err) {
        console.log(err);
      }
      // si this.cpts.length est égal à 100, il faut refaire une requête pour récupérer les 100 suivants
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
    toggleAllButton(filter) {
      console.log('le bouton "tout est activé');
      filter.terms.forEach((term) => {
        if (term.active) {
          this.isAllButtonToggled = false;
        }
      });
      this.recordFilteredCpts();
    },
    displayPostAccordingMaxDisplayable(cpt) {
      console.log("montre les CPT selon le max possible");
      if (cpt.toCome) {
        this.displayablePosts++;
        if (this.displayed < this.maxDisplayable) {
          cpt.display = true;
          this.displayed++;
        } else {
          cpt.display = false;
        }
      }
    },
    handleClick(termName, filter) {
      console.log(termName, filter);
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
      if (termName === "all") {
        this.displayed = 0;
        this.displayablePosts = 0;
        console.log("Clic sur TOUT");
        filter.terms.forEach((term) => {
          if (this.activeTerms.includes(term.name)) {
            this.activeTerms = this.activeTerms.filter(
              (activeTerm) => activeTerm !== term.name
            );
          }
        });
        let filterTaxonomy = filter.taxonomy;
        this.filters.forEach((filter) => {
          if (filter.taxonomy === filterTaxonomy) {
            filter.terms.forEach((term) => {
              term.active = false;
            });
          }
        });
        this.toggleAllButton(filter);
        if (this.activeTerms.length > 0) {
          this.filterCpts();
        } else {
          this.cpts.forEach((cpt) => {
            cpt.show = true;
            this.displayPostAccordingMaxDisplayable(cpt);
          });
        }
      } else {
        console.log("Clic sur un filtre");
        this.filters.forEach((filter) => {
          filter.terms.forEach((term) => {
            if (term.name === termName) {
              if (term.active) {
                term.active = false;
                this.activeTerms = this.activeTerms.filter(
                  (activeTerm) => activeTerm !== term.name
                );
              } else {
                term.active = true;
                filter.isAllButtonToggled = false;
                this.activeTerms.push(term.name);
              }
            }
            // on réactive le button pour tous les termes, mais si un terme est actif, on le désactive, ce qui permet
            // de le réactiver par défaut quand on désactive un terme
          });
          if (filter.terms.find((term) => term.active) !== undefined) {
            filter.isAllButtonToggled = false;
          } else {
            filter.isAllButtonToggled = true;
          }
        });
        this.filterCpts();
      }
      this.hasMoreContent = this.displayed < this.displayablePosts;
    },
    incrementmaxDisplayable() {
      this.maxDisplayable = this.maxDisplayable + this.incrementNumber;

      this.displayed = 0;
      this.cpts.forEach((cpt) => {
        if (this.displayed < this.maxDisplayable) {
          if (cpt.show && cpt.toCome) {
            cpt.display = true;
            this.displayed++;
          }
        }
      });

      this.hasMoreContent = this.displayed < this.displayablePosts;
    },
    recordOriginalCpts() {
      console.log("enregistrement des CPTS originaux");
      this.originalCpts = JSON.parse(JSON.stringify(this.cpts));
    },
    setFirstOptionAsActive() {
      console.log("Activation de la première option en cas de selected");

      this.filters.forEach((filter) => {
        filter.terms[0].active = true;
        this.activeTerms.push(filter.terms[0].name);
      });
      this.filterCpts();
    },
    setMaxDisplayablePosts(value) {
      this.maxDisplayable = parseInt(value);
    },
    setIncrementNumber(value) {
      this.incrementNumber = parseInt(value);
    },
    storeFilters(filters) {
      console.log("stockage des filtres dans le store");
      this.filters = filters;
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
        if (cpt.toCome) {
          const title = cpt.title.rendered.toLowerCase();
          // condition qui permet de vérifier si le mot-clé renvoyé par l'utilisateur correspond à une des propriétés du custom post type
          let match = false;
          for (const key in cpt.acf) {
            if (cpt.acf[key] && typeof cpt.acf[key] === "string") {
              if (
                he
                  .decode(cpt.acf[key].toLowerCase())
                  .includes(keyword.toLowerCase())
              ) {
                match = true;
                break;
              }
            }
          }

          // vérification des terms du custom post type
          if (cpt.terms.length > 0) {
            for (const key in cpt.terms) {
              if (
                he
                  .decode(cpt.terms[key].name)
                  .toLowerCase()
                  .includes(keyword.toLowerCase())
              ) {
                match = true;
                break;
              }
              break;
            }
          }

          if (
            (he.decode(title).includes(keyword.toLowerCase()) || match) &&
            cpt.show
          ) {
            this.displayablePosts++;
            cpt.display = false;
            if (this.displayed < this.maxDisplayable) {
              cpt.display = true;
              this.displayed++;
            }
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
          /*           this.postsFilteredByKeyword = true;
           */ console.log("l'utilisateur efface mais le champ n'est pas vide");
          this.userSearchOrDeleteKeyword(keyword);
        }
      }
    },
    filterCpts() {
      console.log("les CPTS sont filtrés");
      this.displayablePosts = 0;
      this.displayed = 0;
      this.cpts.forEach((cpt) => {
        // On vérifie tous les terms actifs, et si l'un des terms du CPT correspond à l'un des terms actif, alors on affiche le CPT
        if (this.activeTerms.length > 0) {
          cpt.show = this.activeTerms.some((activeTerm) => {
            if (cpt.terms.length > 0) {
              return cpt.terms.some((term) => term.name === activeTerm);
            }
          });
          if (cpt.show) {
            this.displayPostAccordingMaxDisplayable(cpt);
          }
        } else {
          // aucun term n'est actif, on affiche tout
          console.log("Aucun term actif, on affiche tout");
          cpt.show = true;
          this.displayPostAccordingMaxDisplayable(cpt);
        }
      });
      this.hasMoreContent = this.displayed < this.displayablePosts;
      this.recordFilteredCpts();
    },
    recordFilteredCpts() {
      console.log("enregistrement des CPTS filtrés");
      this.filteredCpts = JSON.parse(JSON.stringify(this.cpts));
    },
  },
};
</script>

<template>
  <FiltersCpts
    v-show="isLoaded"
    :filters="filters"
    :search-input="searchInput"
    :filter-type="filterType"
    @handleClick="handleClick"
    @filterElementsByKeyword="filterElementsByKeyword"
    :texteTouslesFiltres1="texteTouslesFiltres1"
    :texteTouslesFiltres2="texteTouslesFiltres2"
    :texteTouslesFiltres3="texteTouslesFiltres3"
    :texteTouslesFiltres4="texteTouslesFiltres4"
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
          :texteFinCandidature="texteFinCandidature"
          :afficherBoutonFicheDePoste="afficherBoutonFicheDePoste"
          :texteEnSavoirPlus="texteEnSavoirPlus"
          :texteBoutonFicheDePoste="texteBoutonFicheDePoste"
          :showTaxonomies="showTaxonomies"
        />
      </div>
      <div
        @click="incrementmaxDisplayable"
        v-if="hasMoreContent"
        class="load-more"
      >
        {{ loadMoreText }}
      </div>
    </template>
    <template v-else>
      <div class="results">
        <OffreEmploi
          v-show="cpt.show && cpt.display"
          class="cpt-extrait"
          v-for="cpt in cpts"
          :key="cpt.id"
          :cpt="cpt"
          :texteFinCandidature="texteFinCandidature"
          :afficherBoutonFicheDePoste="afficherBoutonFicheDePoste"
          :texteEnSavoirPlus="texteEnSavoirPlus"
          :texteBoutonFicheDePoste="texteBoutonFicheDePoste"
          :showTaxonomies="showTaxonomies"
        />
      </div>
      <div
        @click="incrementmaxDisplayable"
        v-if="hasMoreContent"
        class="load-more"
      >
        {{ loadMoreText }}
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
