let vm = new Vue({
    el : '#app',
    data : {
        newTodo : '',
        todos : [],
        done : false
    },
    methods : {
        addTodo : function(){
            let newItem = this.newTodo.trim()

            if(newItem) {
                this.todos.push(
                    {text : this.newTodo, done : false}
                )
                this.newTodo='';

                this.$http({
                    url : 'api/index.php',
                    method : 'POST',
                    body : {
                        text : newItem,
                        done : false,
                        id_date : Date.now(),
                    }
                }).then((response) => {
                    console.log(response.data);
                });
                

            }
        },
        removeTodo : function(index, id_date){
            this.todos.splice(index, 1);

           this.$http({
               url : 'api/index.php?id=' + id_date,
               method : 'DELETE'
           }).then((response) => {
                
           });
        },



        toggleC : function(todo){
            (todo.done == 0) ? false : true;
            todo.done = !todo.done;

            this.$http({
                url : 'api/index.php?id=' + todo.id_date + '&done=' + todo.done,
                method : 'PATCH'
            }).then((response) => {
                 
            });


        },
        getTodo : function(){
            this.$http({
                url : 'api/index.php',
                method : 'GET'
            }).then((response) => {
                // console.log(response.data);
                this.todos = response.data;
            });
        }
    },
    mounted() {
        this.getTodo();
    },

});

Vue.http.options.emulateJSON = true;