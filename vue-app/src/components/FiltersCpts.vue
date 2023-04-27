<script>
import SvgLoop from "../svg/SvgLoop.vue";

export default {
  name: "FiltersCpts",
  props: {
    filters: {
      type: Array,
      default: () => [],
    },
    filterType: {
      type: String,
      default: "",
    },
    searchInput: {
      type: Boolean,
      default: false,
    },
    texteTouslesFiltres1: {
      type: String,
      default: "Tous les filtres",
    },
    texteTouslesFiltres2: {
      type: String,
      default: "Tous les filtres",
    },
    texteTouslesFiltres3: {
      type: String,
      default: "Tous les filtres",
    },
    texteTouslesFiltres4: {
      type: String,
      default: "Tous les filtres",
    },
  },
  components: {
    SvgLoop,
  },
  data() {
    return {
      userEntry: "",
      selects: [],
    };
  },
  methods: {
    handleSelected(option, taxonomy) {
      console.log("gestion du clic des selected");
      this.filters.forEach((filter) => {
        if (filter.taxonomy === taxonomy) {
          filter.terms.forEach((term) => {
            if (term.name === option) {
              term.active = true;
              filter.isAllButtonToggled = false;
              this.activeTerms.push(term.name);
            } else {
              if (term.active) {
                term.active = false;
                this.activeTerms = this.activeTerms.filter(
                  (activeTerm) => activeTerm !== term.name
                );
              }
            }
          });
        }
      });
      this.filterCpts();
    },
  },
  updated() {
    console.log(this.$props[`texteTouslesFiltres${1}`]);
    console.log(this.$props);
  },
};
</script>

<template>
  <div class="filters">
    <!-- Filtre avec boutons -->
    <template v-if="this.filterType === 'boutons'">
      <div
        class="buttons"
        v-for="(filter, index) in filters"
        :key="filter.taxonomy"
      >
        <div
          :class="filter.isAllButtonToggled ? 'active' : ''"
          @click="
            () => {
              if (!filter.isAllButtonToggled) {
                $emit('handleClick', 'all', filter);
                filter.isAllButtonToggled = !filter.isAllButtonToggled;
              }
            }
          "
          class="button"
        >
          {{ this.$props[`texteTouslesFiltres${index + 1}`] }}
        </div>
        <div
          @click="$emit('handleClick', term.name, filter)"
          :class="term.active ? 'active' : ''"
          class="button"
          v-for="term in filter.terms"
          :key="term.id"
        >
          {{ term.name }}
        </div>
      </div>
    </template>

    <!-- Filtre avec select -->
    <div class="selects-container" v-else>
      <label for=""></label>
      <select
        v-for="filter in filters"
        :key="filter.taxonomy"
        @change="
          (e) => {
            this.handleSelected(e.target.value, filter.taxonomy);
          }
        "
      >
        <option v-for="term in filter.terms" :key="term.id">
          {{ term.name }}
        </option>
      </select>
    </div>
    <!-- Champ pour filtrer les résultats de la page -->
    <div v-if="searchInput" class="text-filter-container">
      <SvgLoop />
      <input
        v-if="searchInput"
        type="text"
        v-model="userEntry"
        @input="$emit('filterElementsByKeyword', userEntry)"
        class="filter-input"
      />
    </div>
  </div>
</template>

<style lang="scss" scoped>
// le code scss se trouve dans le thème enfant

// décommenter ce code uniquemet dans le contexte de npm run dev / npm run serve
/* 
#block-app {
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
