new Vue({
    el: '#app',
    delimiters: ['${', '}'],
    data: {
        info: [],
        content: '',
        addComment: '',
        currentDate: new Date(),
    },
    filters: {
        // formatage de la date
        formatDate(value) {
            if (value) {
                return moment(String(value)).format('DD/MM/YYYY');
            }
        }
    },
    // permet d'avoir le focus sur l'input dès que l'évennement est déclenché
    directives: {
        focus: {
            inserted: function (el) {
                el.focus()
            }
        }
    },
    methods: {
        // apparition du formulaire
        editComment(comment) {
            comment.editing = true;
        },
        // disparition du formulaire
        stopEdit(comment) {
            comment.editing = false;
        },
        // modification d'un commentaire
        validEdit(comment) {
            // TODO ajout de la date de modification
            // récupération de l'id du produit pour affichage de ses commentaires
            let commentary = document.querySelector('#comment');
            let idComment = commentary.getAttribute('data-id');
            let content = {
                "content": comment.content,
                "edit": this.currentDate
            }
            // récupération de l'id du produit
            let product = document.querySelector('#product');
            let idProduct = product.getAttribute('data-id');
            // envoie de la modification en bdd
            axios
                .put('http://localhost:8000/api/comments/' + idComment, content);
            // récupération des commentaires
            axios
                .get('http://localhost:8000/api/comments?product=' + idProduct)
                .then(response => (this.info = response.data));

            // disparition du formulaire
            this.stopEdit(comment);
        },
        // ajout d'un commentaire en bdd
        validNewComment() {
            // récupération de l'id du produit
            let product = document.querySelector('#product');
            let idProduct = product.getAttribute('data-id');
            // envoie en bdd
            let data = {
                'content': this.addComment,
                'date': this.currentDate,
                'product': '/api/products/' + idProduct,
                'editing': 0,
            };
            // envoie du commentaire
            axios
                .post('http://localhost:8000/api/comments', data);
            // récupération des commentaires pour affichage
            axios
                .get('http://localhost:8000/api/comments?product=' + idProduct)
                .then(response => (this.info = response.data));
        },
        // suppression commentaire
        deleteComment(comment) {
            console.log(comment.id);
            // récupération de l'id du produit
            let product = document.querySelector('#product');
            let idProduct = product.getAttribute('data-id');
            axios
                .delete('http://localhost:8000/api/comments/' + comment.id);
            axios
                .get('http://localhost:8000/api/comments?product=' + idProduct)
                .then(response => (this.info = response.data));
        }
    },
    mounted() {
        // récupération de l'id du produit pour affichage de ses commentaires
        let product = document.querySelector('#product');
        let idProduct = product.getAttribute('data-id');
        // appel axios, récupération des commentaires
        axios
            .get('http://localhost:8000/api/comments?product=' + idProduct)
            .then(response => (this.info = response.data));
    }
})

