import React from 'react'
import Head from './Head.jsx'
import TextField from './TextField.jsx'

class ItemCart extends React.Component
{
    constructor(props)
    {
        super(props);
        this.state = {
            quantity: 1
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
        this.props.onChange(e);
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
        let { image, title, price } = this.props.data;
        return(
            <div className="row" style={{padding: '5px', height: '109px'}}>
                    <div className="col-md-2">
                        <img src={require(`../assets/img/${image}`)} width={100} height={100} />
                    </div>
                    <div className="col-md-2 padd-0" style={{lineHeight: '92px'}}>
                        <p>{title}</p>
                    </div>
                    <div className="col-md-2">
                         <TextField type="number"
                             name="quantity"
                             value={this.state.quantity}
                             onChange={this._onChange}
                         />
                    </div>
                    <div className="col-md-6" style={{display: 'flex', justifyContent: 'flex-end'}}>
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
        this._total = this._total.bind(this);
        this._clearCart = this._clearCart.bind(this);
        this._onChange = this._onChange.bind(this);
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

    _clearCart()
    {
        sessionStorage.clear();
        location.reload();
    }

    _onChange(e) {
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
                             Total: {this._total()}$
                         </div>
                     </div>
                     <div className="row">
                         <div className="container padd-top-20" style={{display: 'flex', justifyContent: 'space-between'}}>
                             {sessionStorage.length > 0 ?
                               <button className="btn btn-info margin-left-80" onClick={this._clearCart}>Clear cart</button>
                               : null}
                             {sessionStorage.length > 0 ?
                              <a href="/checkout" className="link-checkout">
                                 Checkout
                             </a> : null}
                         </div>
                     </div>
                 </div>
            </div>
        );
    }
}