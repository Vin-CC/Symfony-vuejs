<template>
    <div class="">
        <ul class="pagination">
            <li class="pagination-item">
                <button
                    type="button"
                    @click="onClickFirstPage"
                    :disabled="isInFirstPage"
                    aria-label="Go to first page"
                    class="checktext">
                    First
                </button>
            </li>
            <li class="pagination-item">
                <button
                    type="button"
                    @click="onClickPreviousPage"
                    :disabled="isInFirstPage"
                    aria-label="Go to previous page"
                    class="checktext">
                    Previous
                </button>
            </li>
            <li v-for="page in pages" class="pagination-item">
                <button
                    type="button"
                    @click="onClickPage(page.name)"
                    :disabled="page.isDisabled"
                    class="checktext"
                    :class="{ active: isPageActive(page.name) }"
                    :aria-label="`Go to page number ${page.name}`">
                    {{ page.name }}
                </button>
            </li>
            <li class="pagination-item">
                <button
                    type="button"
                    @click="onClickNextPage"
                    :disabled="isInLastPage"
                    aria-label="Go to next page"
                    class="checktext">
                    Next
                </button>
            </li>
            <li class="pagination-item">
                <button
                    type="button"
                    @click="onClickLastPage"
                    :disabled="isInLastPage"
                    aria-label="Go to last page"
                    class="checktext">
                    Last
                </button>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'pagination',
    props: {
        maxVisibleButtons: {
            type: Number,
            required: false,
            default: 3
        },
        totalPages: {
            type: Number,
            required: true
        },
        total: {
            type: Number,
            required: true
        },
        perPage: {
            type: Number,
            required: true
        },
        currentPage: {
            type: Number,
            required: true
        },
    },
    computed: {
        startPage() {
            if (this.currentPage === 1) {
                return 1;
            }

            if (this.currentPage === this.totalPages) {
                return this.totalPages - this.maxVisibleButtons + 1;
            }

            return this.currentPage - 1;
        },
        endPage() {
            return Math.min(this.startPage + this.maxVisibleButtons - 1, this.totalPages);
        },
        pages() {
            const range = [];

            for (let i = this.startPage; i <= this.endPage; i+= 1 ) {
                range.push({
                    name: i,
                    isDisabled: i === this.currentPage
                });
            }

            return range;
        },
        isInFirstPage() {
            return this.currentPage === 1;
        },
        isInLastPage() {
            return this.currentPage === this.totalPages;
        },
    },
    methods: {
        onClickFirstPage() {
            this.$emit('pagechanged', 1);
        },
        onClickPreviousPage() {
            this.$emit('pagechanged', this.currentPage - 1);
        },
        onClickPage(page) {
            this.$emit('pagechanged', page);
        },
        onClickNextPage() {
            this.$emit('pagechanged', this.currentPage + 1);
        },
        onClickLastPage() {
            this.$emit('pagechanged', this.totalPages);
        },
        isPageActive(page) {
            return this.currentPage === page;
        },
    }
}
</script>

<style scoped>
    .pagination {
        list-style-type: none;
        margin: 2em 0;
        padding: 0;
        text-align: center;
    }
    .pagination-item {
        display: inline-block;
    }
    .active {
        background-color: #4AAE9B;
        color: #ffffff;
    }
    button.checktext {
        border-right: none;
        border-left: none;
        border-top: none;
        display: inline-block;
        cursor: pointer;
        color: #5c616c;
        border-bottom: .125em solid #5c616c;
        margin: .7em .5em;
        line-height: 1em;
        transition: transform .2s;
        background-color: transparent;
        font-size: 16px;
        border-radius: 0;
        font-weight: inherit;
        width: auto;
        height: auto;
    }
    button.checktext:hover {
        transform:scale(1.3);
        box-shadow: none;
    }
    button.checktext.active {
        color:#000;
        font-weight:bold;
        font-size:2.5em;
        margin:-.25em .255em 0;
        transform:translateY(.12em);
        border-color:#367bf0
    }
</style>
