import React from 'react'
import TextField from '../TextField.jsx'
import Head from '../Head.jsx'
import axios from 'axios'
import * as config from '../../config'

export default class Login extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            login: '',
            password: '',
            error: ''
        },
        this._onSubmit = this._onSubmit.bind(this);
        this._onChange = this._onChange.bind(this);
    }

    _onSubmit(e) {
        e.preventDefault();
        let self = this;
        axios.post(config.API_USER_LOGIN, {
             login: self.state.login,
             password: self.state.password
        }).then(data => {
            localStorage.setItem('access_token', data.data.response);
            setTimeout(() => {
                location.replace('/');
            }, 1000);
        }).catch(err => {
            this.setState({ error: err.response.data.message });
        });
    }

    _onChange(e) {
        this.setState({ [e.target.name]: e.target.value });
    }

    render() {
        return (
            <div>
                <Head/>
                <h2 className="text-center">Login</h2>
                <p className="text-center" style={{ color: 'red' }}>{this.state.error}</p>
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
                        <TextField type="password"
                                   placeholder="Password"
                                   name="password"
                                   value={this.state.password}
                                   required
                        />
                    </div>
                    <div className="col-md-1 offset-md-1">
                        <button className="btn btn-outline-success" type="submit">Login</button>
                    </div>
                </form>
            </div>
        );
    }
}