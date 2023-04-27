<script>
export default {
  name: "ExcerptAgenda",
  props: {
    cpt: {
      type: Object,
    },
    texteFinCandidature: {
      type: String,
    },
    afficherBoutonFicheDePoste: {
      type: String,
    },
    texteBoutonFicheDePoste: {
      type: String,
    },
    texteEnSavoirPlus: {
      type: String,
    },
    texteDateDeLevenement: {
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
    <h2>{{ cpt.title.rendered }}</h2>
    <span
      class="date-evenement"
      v-if="cpt.type === 'evenement' || cpt.type === 'appel_a_projet'"
    >
      <span> {{ texteDateDeLevenement }} </span>
      &nbsp;{{ cpt.acf.date_de_levenement }}
    </span>
    <p
      v-if="cpt.acf.hasOwnProperty('description_extrait_de_la_page')"
      class="desc-page"
    >
      {{ cpt.acf.description_extrait_de_la_page }}
    </p>
    <span class="lieu-evenement" v-if="cpt.acf.lieu_evenement">
      {{ cpt.acf.lieu_evenement }}
    </span>
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
      <template
        v-if="cpt.acf.url_pour_le_bouton_en_savoir_plus.hasOwnProperty('url')"
      >
        <p
          class="cta_btn_lead cta_secondaire"
          :class="{ cta_center: !afficherBoutonFicheDePoste }"
        >
          <a
            target="_blank"
            :href="cpt.acf.url_pour_le_bouton_en_savoir_plus.url"
          >
            {{ texteEnSavoirPlus }}
          </a>
        </p>
      </template>
    </div>
  </div>
</template>

<style></style>
