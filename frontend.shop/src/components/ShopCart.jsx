import React from 'react'
import Head from './Head.jsx'
import TextField from './TextField.jsx'
import axios from "axios";
import * as config from "../config";

class ItemCart extends React.Component
{
    constructor(props)
    {
        super(props);
        this.state = {
            quantity: this.props.data.quantity
        };
        this._removeItem = this._removeItem.bind(this);
        this._onChange = this._onChange.bind(this);
    }

    componentDidMount()
    {}

    _removeItem()
    {
        sessionStorage.removeItem(this.props.data.id);
        window.location.reload();
    }

    _onChange(e)
    {
        this.props.onChange(e, this.props.data.id);
        let state = this.state;
        let value = e.target.value;
        let name = e.target.name;
        if(value === 0 || value < 0)
        {
            state[name] = 1;
        } else {
            state[name] = value;
        }
        this.setState(state);
    }

    render()
    {
        let { title, price } = this.props.data;
        return(
            <div className="row" style={{padding: '5px', height: '109px'}}>
                    <div className="col-md-5" style={{lineHeight: '92px'}}>
                        <p>{title}</p>
                    </div>
                    <div className="col-md-2">
                         <TextField type="number"
                             name="quantity"
                             value={this.state.quantity}
                             onChange={this._onChange}
                         />
                    </div>
                    <div className="col-md-5" style={{display: 'flex', justifyContent: 'flex-end', marginTop: '19px'}}>
                        <strong className="book-price">{price * this.state.quantity}$</strong>
                        <div className="col-md-1">
                            <button type="button" className="btn btn-outline-danger" onClick={this._removeItem}>
                                <i className="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
            </div>
        );
    }
}

export default class ShopCart extends React.Component
{
    constructor(props)
    {
        super(props);
        this.state = {
            products: [],
            quantity: 1
        };
        this._clearCart = this._clearCart.bind(this);
        this._onChange = this._onChange.bind(this);
        this._addOrder = this._addOrder.bind(this);
        this._total = this._total.bind(this);
    }

    componentDidMount()
    {
        let products = [];
        for(let i=0; i<sessionStorage.length; i++)
        {
            products.push(JSON.parse(sessionStorage.getItem(sessionStorage.key(i))));
        }
        this.setState({ products: products });
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

    _addOrder() {
        axios.post(config.API_ORDER_ADD, {
            token: localStorage.getItem('access_token'),
            OrderQuantity: this.state.quantity,
            OrderTotal: this._total(),
            cart: JSON.stringify(this.state.products)
        }).then((data) => {
                sessionStorage.clear();
                location.replace('/');
            }).catch(err => {});
    }

    _clearCart()
    {
        sessionStorage.clear();
        location.reload();
    }

    _onChange(e, id) {
        let state = this.state;
        let products = [];
        for(let i=0; i<sessionStorage.length; i++)
        {
            products.push(JSON.parse(sessionStorage.getItem(sessionStorage.key(i))));
        }
        let {value,name} = e.target;
        if(value === 0 || value < 0)
        {
            state[name] = 1;
        } else {state[name] = value;}
        let res = products.filter(item => {
            return item.id === id;
        });
        if (res.hasOwnProperty('quantity')) {
            res[0].quantity = 1;
        } else {
            res[0].quantity = parseInt(value);
        }
        window.sessionStorage.setItem(id, JSON.stringify(res[0]));
        this.setState(state);
    }

    render()
    {
        //total price
        let total = 0;
        let productss = [];
        for(let i=0; i<sessionStorage.length; i++)
        {
            productss.push(JSON.parse(sessionStorage.getItem(sessionStorage.key(i))));
        }
        for(let i=0; i<productss.length; i++)
        {
            total += productss[i].price * productss[i].quantity;
        }

        let state = this.state;
        let products = [];
        for(let i=0; i<state.products.length; i++)
        {
            let product = state.products[i];
            products.push(
                <ItemCart data={product} onChange={this._onChange}/>
            );
        }
        return(
            <div className="row clearfix">
                 <Head/>
                 <div className="row clearfix" style={{display: 'flex', justifyContent: 'center'}}>
                     <div className="col-md-9 shop-cart padd-0">
                         {products}
                         <h1 className="text-secondary text-center">{sessionStorage.length === 0 ? 'Cart is empty' : null}</h1>
                         <div className="total-products">
                             Total: {total}$
                         </div>
                     </div>
                     <div className="row">
                         <div className="container padd-top-20" style={{display: 'flex', justifyContent: 'space-between'}}>
                             {sessionStorage.length > 0 ?
                               <button className="btn btn-info margin-left-80" onClick={this._clearCart}>Clear cart</button>
                               : null}
                             {sessionStorage.length > 0 ?
                                 <button className="link-checkout" onClick={this._addOrder}>
                                     Order
                                 </button> : null}
                         </div>
                     </div>
                 </div>
            </div>
        );
    }
}