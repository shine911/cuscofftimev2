<template>
    <vdtnet-table ref="table" :fields="fields"></vdtnet-table>
</template>

<script>
export default {
    data() {
        return {
            fields: {
                id: {
                    label: 'ID',
                    sortable: true
                },
                actions: {
                    isLocal: true,
                    label: 'Actions',
                    defaultContent: '<a href="javascript:void(0);" data-action="edit" class="btn btn-primary btn-sm"><i class="mdi mdi-square-edit-outline"></i> Edit</a>' +
                        '<span data-action="delete" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i> Delete</span>'
                },
                name: {
                    label: 'Name',
                    sortable: true,
                    searchable: true,
                    defaultOrder: 'desc'
                },
                username: {
                    label: 'Username',
                    sortable: false,
                    searchable: true
                },
                email: {
                    label: 'Email'
                },
                address: {
                    label: 'Address',
                    //template: '{{ data.street }}, {{ data.suite }}, {{ data.city }} {{ data.zipcode }}'
                },
                phone: {
                    label: 'Phone'
                },
                website: {
                    label: 'Website',
                    
                }
            }
        }
    }
}
</script>
