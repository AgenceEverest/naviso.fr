<script>
import { getApiData } from "../../utils/getApi";

export default {
  name: "RessourceDocumentaire",
  props: {
    cpt: {
      type: Object,
    },
    texteFinCandidature: {
      type: String,
    },
    afficherBoutonTelechargement: {
      type: String,
    },
    texteBoutonFicheDePoste: {
      type: String,
    },
    texteBoutonTelecharger: {
      type: String,
    },
    protocol: {
      type: String,
    },
    showTaxonomies: {
      type: Object,
    },
    website: {
      type: String,
    },
  },

  methods: {
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
  },
};
</script>

<template>
  <div>
    <h2>{{ cpt.title.rendered }}</h2>
    <p v-if="cpt.acf.hasOwnProperty('sous_titre_ressource')" class="employeur">
      {{ cpt.acf.sous_titre_ressource }}
    </p>
    <p
      v-if="cpt.acf.hasOwnProperty('description_extrait_de_la_page')"
      class="desc-page"
    >
      {{ cpt.acf.description_extrait_de_la_page }}
    </p>
    <span v-if="cpt.acf.date_de_levenement">
      {{ cpt.acf.date_de_levenement }}
    </span>
    -
    <span v-if="cpt.acf.lieu_evenement">
      {{ cpt.acf.lieu_evenement }}
    </span>
    <p v-if="cpt.acf.hasOwnProperty('date_de_fin_de_candidature')">
      {{ texteFinCandidature }}
      {{ convertToFrenchDate(cpt.acf.date_de_fin_de_candidature) }}
    </p>
    <!--      <p>{{ cpt.acf.lieu }}</p> -->
    <template v-if="cpt.hasOwnProperty('_embedded')">
      <div
        v-if="cpt.acf.afficher_banniere_avec_du_texte_libre"
        class="banner-texte-libre"
      >
        {{ cpt.acf.banniere_avec_du_texte_libre }}
      </div>
      <div
        v-for="(terms, indexTaxo) in cpt._embedded['wp:term']"
        :key="indexTaxo"
        :class="'term taxo-' + indexTaxo"
        v-show="showTaxonomies[`${indexTaxo + 1}`]"
      >
        <span
          :class="' term-' + indexTerm"
          v-for="(term, indexTerm) in terms.slice(0, 1)"
          :key="term.id"
        >
          {{ term.name }}
        </span>
      </div>
    </template>
    <div class="buttons-extrait">
      <p
        class="cta_btn_lead cta_secondaire"
        :class="{ cta_center: !afficherBoutonFicheDePoste }"
      >
        <a target="_blank" :href="cpt.acf.fichier_a_telecharger">
          {{ texteBoutonTelecharger }}
        </a>
      </p>
    </div>
  </div>
</template>

<style></style>
