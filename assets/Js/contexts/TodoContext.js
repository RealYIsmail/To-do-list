import axios from 'axios';
import React, {createContext} from 'react';

export const TodoContext = createContext();

class TodoContextProvider extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            todos: [],
        };
        this.readTodo();
    }
    // function that allows axios to send a request and will create content on the database
    //create
    createTodo(event, todo) {
        event.preventDefault();
        axios.post('/api/todo/create', todo)
            .then(response => {
                console.log(response.data);
                let data = [...this.state.todos];
                data.push(response.data.todo);
                this.setState({
                    todos: data,
                });
            }).catch(error => {
            console.error(error);
        });

    }

    // function that allows axios to send a request and will read content on the database which will be shown on the table
    //read
    readTodo() {
        axios.get('/api/todo/read')
            .then(response => {
                this.setState({
                    todos: response.data,
                });
            }).catch(error => {
            console.error(error);
        });
    }

    // function that allows axios to send a request and can update content on the database
    //update
    updateTodo(data) {
        axios.put('/api/todo/update/' + data.id, data)
            .then(response => {
                let todos = [...this.state.todos];
                let todo = todos.find(todo => {
                    return todo.id === data.id;
                });

                todo.name = data.name;

                this.setState({
                    todos: todos,
                });
            }).catch(error => {
            console.error(error);
        })
    }

    // function that allows axios to send a request and will delete content on the database and therefore be removed from the table
    //delete
    deleteTodo(data) {
        axios.delete('/api/todo/delete/' + data.id)
            .then(response => {
                //message
                let todos = [...this.state.todos];
                let todo = todos.find(todo => {
                    return todo.id === data.id;
                });

                todos.splice(todos.indexOf(todo), 1);

                this.setState({
                    todos: todos,
                });
            }).catch(error => { 
            console.error(error);
        });
    }

    render() {
        return (
            <TodoContext.Provider value={{
                ...this.state,
                createTodo: this.createTodo.bind(this),
                updateTodo: this.updateTodo.bind(this),
                deleteTodo: this.deleteTodo.bind(this),
            }}>
                {this.props.children}
            </TodoContext.Provider>
        );
    }
}

export default TodoContextProvider; 