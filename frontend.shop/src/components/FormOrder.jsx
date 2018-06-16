import React from 'react'
import Head from './Head.jsx'
import TextField from './TextField.jsx'
import axios from 'axios'
import * as config from '../config'
import NotificationSystem from 'react-notification-system'

export default class FormOrder extends React.Component
{
    constructor(props)
    {
        super(props);
        this.state = {
            products: [],
            quantity: 0,
            _notificationSystem: null,
            errors: {}
        };
        this._onChange = this._onChange.bind(this);
        this._onSubmit = this._onSubmit.bind(this);
        this._total = this._total.bind(this);
        this._addNotification = this._addNotification.bind(this);
    }

    _addNotification(msg, level)
    {
        this.state._notificationSystem.addNotification({
            message: msg,
            level: level,
            position:  'tl'
        });
    }

    componentDidMount()
    {
        let products = [];
        for(let i=0; i<sessionStorage.length; i++)
        {
            products.push(JSON.parse(sessionStorage.getItem(sessionStorage.key(i))));
        }
        this.setState({ products: products, quantity: products.length })
    }

    _onChange(e)
    {
        let state = this.state;
        state[e.target.name] = e.target.value;
        this.setState(state);
    }

    _total()
    {
        let products = this.state.products;
        let total = 0;
        for(let i=0; i<products.length; i++)
        {
            total += products[i].price;
        }
        return total;
    }

    _onSubmit(e)
    {
        e.preventDefault();
        let state = this.state;
        let data = {
            name: state.name,
            email: state.email,
            phone: parseInt(state.phone),
            address: state.address,
            OrderQuantity: state.quantity,
            OrderTotal: this._total(),
            city: state.city,
            cart: JSON.stringify(state.products)
        };

        axios.post(config.API_ORDER_ADD, data)
            .then((data) => {
                sessionStorage.clear();
                location.replace('/');
            }).catch(err => {
                let error = err.response.data;
                for(let key in error)
                {
                    state.errors[key] = error[key].join();
                }
            });
        console.log(state.errors.length);
        this.setState(state);
    }

    render()
    {
        return(
            <div className="row">
                <Head/>
                <NotificationSystem ref="notificationSystem" />
                <div className="container display-flex">
                     <form method="POST" onSubmit={this._onSubmit}>
                         <div className="row">
                             <TextField type="text"
                                 placeholder="Name"
                                 name="name"
                                 error={this.state.errors.name}
                                 value={this.state.name}
                                 onChange={this._onChange}
                                 required
                             />
                         </div>
                         <div className="row">
                             <TextField type="email"
                                        placeholder="Email"
                                        name="email"
                                        error={this.state.errors.email}
                                        value={this.state.email}
                                        onChange={this._onChange}
                                        required
                             />
                         </div>
                         <div className="row">
                             <TextField type="text"
                                        placeholder="Address"
                                        name="address"
                                        error={this.state.errors.address}
                                        value={this.state.address}
                                        onChange={this._onChange}
                                        required
                             />
                         </div>
                         <div className="row">
                             <TextField type="text"
                                        placeholder="Phone"
                                        name="phone"
                                        error={this.state.errors.phone}
                                        value={this.state.phone}
                                        onChange={this._onChange}
                                        required
                             />
                         </div>
                         <div className="row">
                             <TextField type="text"
                                        placeholder="City"
                                        name="city"
                                        error={this.state.errors.city}
                                        value={this.state.city}
                                        onChange={this._onChange}
                                        required
                             />
                         </div>
                         <div className="row display-flex">
                             <button type="submit" className="btn btn-outline-success">Send</button>
                         </div>
                     </form>
                </div>
            </div>
        );
    }
}