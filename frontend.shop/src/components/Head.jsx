import React from 'react'

export default class Head extends React.Component
{
    constructor(props)
    {
        super(props);
        this.state = {
            token: localStorage.getItem('access_token')
        },
        this._exitSystem = this._exitSystem.bind(this);
    }

    _exitSystem() {
        localStorage.clear();
        location.replace('/');
    }

    render()
    {
        return(
            <div className="row clearfix">
                <nav className="row menu">
                    <ul>
                        <li><a href="/">Christian books</a></li>
                        <li><a href="http://localhost:4999/#/" target="_blank">Christian blog</a></li>
                        {this.state.token !== null ?
                            <div style={{display: 'flex'}}>
                                <li><a href="#/profile">Profile</a></li>
                                <li><a href="#" onClick={this._exitSystem}>Exit</a></li>
                            </div> : null
                        }
                        {this.state.token === null ?
                            <div style={{display: 'flex'}}>
                                <li><a href="#/login">Login</a></li>
                                <li><a href="#/register">Register</a></li>
                            </div> : null
                        }
                        <li><a href="#/shopcart" className="link-shopcart">
                            <i className="fas fa-shopping-bag" style={{fontSize: '25px'}}></i>
                            <h4>{sessionStorage.length > 0 ? sessionStorage.length : null}</h4>
                        </a></li>
                    </ul>
                </nav>
            </div>
        );
    }
}