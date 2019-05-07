<template>
    <div>
            <b-table
                striped
                bordered
                outlined
                hover
                :current-page="currentPage"
                :per-page="perPage"
                :items="dataSource"
                :fields="columnDef"
                >
                    <template slot="actions" slot-scope="row">
                        <b-button  variant="outline-primary" @click="editClick(row.item)" size="sm" class="mr-1">
                            <i class="fas fa-edit"></i>
                        </b-button>
                        <b-button variant="outline-secondary" @click="removeClick(row.item)" size="sm">
                            <i class="fas fa-trash"></i>
                        </b-button>
                    </template>
                </b-table>
            <b-row>
                <b-col md="6" class="my-1">
                    <b-pagination
                    v-model="currentPage"
                    :total-rows="dataSource.length"
                    :per-page="perPage"
                    class="my-0"
                    ></b-pagination>
                </b-col>
            </b-row>
    </div>
</template>
<script>
export default {
    props:{
        dataSource: {
            type: Array,
            default: () => ([])
        },
        columnDef: {
            type: Array,
            default: () => ([])
        }
    },
    data(){
        return {
            currentPage: 1,
            perPage: 5,
        }
    },
    methods:{
        editClick(item){
            this.$emit('editClick', item);
        },
        removeClick(item){
            this.$emit('removeClick', item);
        }
    }
}
</script>
