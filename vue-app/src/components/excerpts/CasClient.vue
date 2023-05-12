<script>
export default {
  name: "WebinaireExcerpt",
  props: {
    cpt: {
      type: Object,
    },
    texteFinCandidature: {
      type: String,
    },
    texteBoutonVideo: {
      type: String,
    },
    texteEnSavoirPlus: {
      type: String,
    },
    showTaxonomies: {
      type: Object,
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
    <div class="terms" v-if="cpt.hasOwnProperty('_embedded')">
      <div v-if="cpt.acf.afficher_banniere_avec_du_texte_libre" class="banner-texte-libre">
        {{ cpt.acf.banniere_avec_du_texte_libre }}
      </div>
      <div v-for="(terms, indexTaxo) in cpt._embedded['wp:term']" :key="indexTaxo" :class="'term taxo-' + indexTaxo"
        v-show="showTaxonomies[`${indexTaxo + 1}`]">
        <span :class="' term-' + indexTerm" v-for="(term, indexTerm) in terms.slice(0, 1)" :key="term.id">
          {{ term.name }}
        </span>
      </div>
    </div>

    <!-- Titre -->
    <h2>{{ cpt.title.rendered }}</h2>
    <p v-if="cpt.acf.hasOwnProperty('nom_employeur')" class="employeur">
      {{ cpt.acf.nom_employeur }}
    </p>

    <!-- Description extrait de page -->
    <p v-if="cpt.acf.hasOwnProperty('description_extrait_de_la_page')" class="desc-page">
      {{ cpt.acf.description_extrait_de_la_page }}
    </p>

    <!-- Boutons de fins de bloc -->
    <div class="buttons-extrait">
      <p v-if="cpt.acf.lien_landing_page_hubspot !== null" class="cta_btn_lead cta_primaire"
        :class="{ cta_center: !cpt.acf.lien_vers_la_video }">
        <a target="_blank" :href="cpt.acf.lien_landing_page_hubspot.url">{{
          texteEnSavoirPlus
        }}</a>
      </p>
      <p v-if="cpt.acf.lien_vers_la_video !== null" class="cta_btn_lead cta_primaire">
        <a target="_blank" :href="cpt.acf.lien_vers_la_video.url">{{ texteBoutonVideo }}</a>
      </p>
    </div>
  </div>
</template>

<style></style>
