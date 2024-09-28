<template>
    <div
      v-if="multiObjectKeys"
    >
      <v-select
        :filter="fuseSearch"
      >
        <template #option="{ name, email }">
          <p>{{ name }} ({{ email }})</p>
        </template>
      </v-select>
    </div>
    <div>
      <v-select
        class="select"
        :class="selectBoxClass"
        v-bind="$attrs"
        :taggable="taggable"
      />
    </div>
  </template>
  
  <script>
  import 'vue-select/dist/vue-select.css';
  import vSelect from 'vue-select';
  import Fuse from 'fuse.js';
  
  export default {
      components:{
          vSelect
      },
      props: {
          multiObjectKeys: {
              type: Boolean,
          },
          selectBoxClass: String,
          taggable: {
              type: Boolean,
              default: false
          }
      },
      methods: {
          fuseSearch(options, search) {
              const fuse = new Fuse(options, {
                  keys: ['id','name','email'],
                  shouldSort: true,
              });
              return search.length
                  ? fuse.search(search).map(({ item }) => item)
                  : fuse.list;
          },
      }
  };
  </script>
  
  <style>
  /* .v-select{
    width:100%
  } */
  .select
  .vs__dropdown-toggle {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      background: none;
      /* border: var(--vs-border-width) var(--vs-border-style) var(--vs-border-color); */
      /* border-radius: var(--vs-border-radius); */
      border: 1px solid #e5e7eb;
      border-radius: 0.375rem;
      display: flex;
      padding: 0 0 4px;
      white-space: normal;
      padding: 6px !important;
  }
  .select
  .vs__selected-options{
    flex-wrap: nowrap;
  }
  </style>
  