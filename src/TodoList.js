import React, { Component } from 'react';
import Todo from './Todo';
import TodoForm from './TodoForm';
import './TodoList.css';

class TodoList extends Component {
	state = {
		todos: []
	};

	create = (newItem) => {
		this.setState({ todos: [ ...this.state.todos, newItem ] });
	};

	remove = (id) => {
		this.setState({ todos: this.state.todos.filter((t) => t.id !== id) });
	};

	toggleCompletion = (id) => {
		const updateTodos = this.state.todos.map((todo) => {
			if (todo.id === id) {
				return {
					...todo,
					completed: !todo.completed
				};
			}
			return todo;
		});
		this.setState({ todos: updateTodos });
	};
	render() {
		const todos = this.state.todos.map((todo) => {
			return (
				<Todo
					completed={todo.completed}
					task={todo.task}
					key={todo.id}
					id={todo.id}
					remove={() => this.remove(todo.id)}
					update={this.toggleCompletion.bind(this, todo.id)}
				/>
			);
		});
		return (
			<div className="TodoList">
				<h1>To-Do List</h1>
				<TodoForm addItem={this.create} />
				<ul>{todos}</ul>
			</div>
		);
	}
}

export default TodoList;
