<script>
import SvgLoop from "../svg/SvgLoop.vue";

export default {
  name: "FiltersCpts",
  emits: ["handleClick", "filterElementsByKeyword"],
  props: {
    dataJson: {
      type: Object,
      default: () => {},
    },
    filters: {
      type: Array,
      default: () => [],
    },
  },
  components: {
    SvgLoop,
  },
  data() {
    return {
      userEntry: "",
    };
  },
  methods: {
    resetUserEntry() {
      this.userEntry = "";
    },
  },
};
</script>

<template>
  <div class="filters">
    <!-- Filtre avec boutons -->
    <template v-if="this.$props.dataJson.type_de_filtre === 'boutons'">
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
          {{ this.$props.dataJson[`texte_tous_les_filtres_${index + 1}`] }}
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
    <!-- Champ pour filtrer les résultats de la page -->
    <div
      v-if="dataJson.champs_texte_pour_affiner"
      class="text-filter-container"
    >
      <SvgLoop />
      <input
        v-if="dataJson.champs_texte_pour_affiner"
        type="text"
        v-model="userEntry"
        @input="$emit('filterElementsByKeyword', userEntry)"
        class="filter-input"
      />
    </div>
  </div>
</template>

<style lang="scss" scoped>
.selects-container {
  color: black;
}
</style>
