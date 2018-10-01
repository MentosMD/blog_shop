import React from 'react'
import TextField from '../TextField.jsx'
import Head from '../Head.jsx'
import axios from 'axios'
import * as config from '../../config'

export default class Register extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            login: '',
            password: '',
            email: '',
            first_name: '',
            last_name: ''
        },
        this._onSubmit = this._onSubmit.bind(this);
        this._onChange = this._onChange.bind(this);
    }

    _onSubmit(e) {
        e.preventDefault();
        let state = this.state;
        axios.post(config.API_USER_REGISTER, {
             login: state.login,
             first_name: state.first_name,
             last_name: state.last_name,
             email: state.email,
             password: state.password,
        }).then(data => {
            location.replace('/');
        }).catch();
    }

    _onChange(e) {
        this.setState({ [e.target.name]: e.target.value });
    }

    render() {
        return (
            <div>
                <Head/>
                <h2 className="text-center">Register</h2>
                <form action="#" method="post" className="col-md-7 offset-md-5"
                      onSubmit={this._onSubmit}
                      onChange={this._onChange}>
                    <div className="col-md-4">
                        <TextField type="text"
                                   placeholder="Login"
                                   name="login"
                                   value={this.state.login}
                                   required
                        />
                    </div>
                    <div className="col-md-4">
                        <TextField type="email"
                                   placeholder="Email"
                                   name="email"
                                   value={this.state.email}
                        />
                    </div>
                    <div className="col-md-4">
                        <TextField type="text"
                                   placeholder="First name"
                                   name="first_name"
                                   value={this.state.first_name}
                        />
                    </div>
                    <div className="col-md-4">
                        <TextField type="text"
                                   placeholder="Last name"
                                   name="last_name"
                                   value={this.state.last_name}
                        />
                    </div>
                    <div className="col-md-4">
                        <TextField type="password"
                                   placeholder="Password"
                                   name="password"
                                   value={this.state.password}
                                   required
                        />
                    </div>
                    <div className="col-md-1 offset-md-1">
                        <button className="btn btn-outline-success" type="submit">Register</button>
                    </div>
                </form>
            </div>
        );
    }
}