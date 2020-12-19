import React, { Component } from 'react';
import './Todo.css';
class Todo extends Component {
	render() {
		return (
			<div className="Todo">
				<button onClick={this.props.remove}>
					<i class="far fa-trash-alt" />
				</button>
				<li className={this.props.completed ? 'completed' : ''} onClick={this.props.update}>
					{this.props.task}
				</li>
			</div>
		);
	}
}

export default Todo;
