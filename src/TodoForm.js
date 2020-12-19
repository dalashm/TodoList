import React, { Component } from 'react';
import './TodoForm.css';
class TodoForm extends Component {
	state = {
		task: ''
	};

	handleChange = (event) => {
		this.setState({ [event.target.name]: event.target.value });
	};

	handleSubmit = (event) => {
		event.preventDefault();
		this.props.addItem({ ...this.state, id: Math.random() * 1000, completed: false });
		this.setState({ task: '' });
	};
	render() {
		return (
			<div>
				<form className="Form" onSubmit={this.handleSubmit}>
					<input
						type="text"
						name="task"
						id="task"
						placeholder="Add New Todo"
						value={this.state.task}
						onChange={this.handleChange}
					/>
					<button>Add Todo</button>
				</form>
			</div>
		);
	}
}
export default TodoForm;
