<script>
export default {
  name: "WebinaireExcerpt",
  props: {
    cpt: {
      type: Object,
    },
    date_de_fin_de_candidature_texte: {
      type: String,
    },
    texte_bouton_video: {
      type: String,
    },
    texte_en_savoir_plus: {
      type: String,
    },
    taxonomiesToShow: {
      type: Array,
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
      <div
        v-if="cpt.acf.afficher_banniere_avec_du_texte_libre"
        class="banner-texte-libre"
      >
        {{ cpt.acf.banniere_avec_du_texte_libre }}
      </div>
      <template
        v-for="(taxo, index) in cpt._embedded['wp:term']"
        :key="taxo.id"
      >
        <span :class="'term term-' + index" v-for="term in taxo" :key="term.id">
          {{ term.name }}
        </span>
      </template>
    </div>

    <!-- Titre -->
    <h2>{{ cpt.title.rendered }}</h2>
    <p v-if="cpt.acf.hasOwnProperty('nom_employeur')" class="employeur">
      {{ cpt.acf.nom_employeur }}
    </p>

    <!-- Description extrait de page -->
    <p
      v-if="cpt.acf.hasOwnProperty('description_extrait_de_la_page')"
      class="desc-page"
    >
      {{ cpt.acf.description_extrait_de_la_page }}
    </p>

    <!-- Boutons de fins de bloc -->
    <div class="buttons-extrait buttons-cas-clients">
      <p
        v-if="cpt.acf.lien_landing_page_hubspot !== null"
        class="cta_btn_lead cta_primaire"
        :class="{ cta_center: !cpt.acf.lien_vers_la_video }"
      >
        <a target="_blank" :href="cpt.acf.lien_landing_page_hubspot.url">{{
          texte_en_savoir_plus
        }}</a>
      </p>
      <p
        v-if="cpt.acf.lien_vers_la_video !== null"
        class="cta_btn_lead cta_primaire"
      >
        <a target="_blank" :href="cpt.acf.lien_vers_la_video.url">{{
          texte_bouton_video
        }}</a>
      </p>
    </div>
  </div>
</template>

<style></style>
