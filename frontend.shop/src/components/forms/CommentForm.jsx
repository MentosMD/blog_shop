import React from 'react'
import TextField from '../TextField.jsx';
import axios from 'axios'
import * as config from '../../config'

export default class CommentForm extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            error: {
                name: '',
                email: '',
                comment: ''
            }
        };
        this._onSubmit = this._onSubmit.bind(this);
        this._onChange = this._onChange.bind(this);
    }

    _onSubmit(e) {
        e.preventDefault();
        let book = this.state;
        book.book_id = this.props.book_id;
        axios.post(config.API_BOOK_COMMENT_ADD, {
            name: book.name,
            email: book.email,
            comment: book.comment,
            book_id: book.book_id
        }).then(data => {
            setTimeout(() => {
                location.replace('/');
            }, 1000);
        }).catch(err => {
            console.log(err);
        });
    }

    _onChange(e) {
        let {name, value} = e.target;
        this.setState({ [name]: value });
    }

    render() {
        return(
            <div className="row">
                <div className="container display-flex">
                    <form action="" methods="POST" className="col-md-7" onSubmit={this._onSubmit}>
                        <div className="col-md-4">
                            <TextField
                                type="text"
                                name="name"
                                onChange={this._onChange}
                                placeholder="Name"
                                required
                            />
                        </div>
                        <div className="col-md-4">
                            <TextField
                                type="email"
                                name="email"
                                onChange={this._onChange}
                                placeholder="Email"
                                required
                            />
                        </div>
                        <div className="col-md-4">
                            <textarea name="comment"
                                      onChange={this._onChange}
                                      required>
                            </textarea>
                        </div>
                        <div className="col-md-1">
                            <button type="submit" className="btn btn-outline-success">Add comment</button>
                        </div>
                    </form>
                </div>
            </div>
        );
    }
}