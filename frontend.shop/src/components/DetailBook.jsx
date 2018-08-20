import React from 'react'
import axios from 'axios'
import * as config from '../config'
import Head from './Head.jsx'

export default class DetailBook extends React.Component
{
    constructor(props)
    {
        super(props);
        this.state = {
            book: {},
            id: this.props.match.params.id
        };
        this._addToCart = this._addToCart.bind(this);
    }

    componentDidMount()
    {
        axios.get(`${config.API_BOOK_DETAIL}${this.state.id}`)
            .then((data) => {
                this.setState({
                    book: data.data.response
                });
            }).catch((err) => {
            console.log(err);
        });
    }

    _addToCart()
    {
        let {book} = this.state;
        window.sessionStorage.setItem(book.id, JSON.stringify(book));
        alert('Successfully added in cart');
    }

    render()
    {
        let {book} = this.state;
        if (book.image === undefined)
        {
            return null;
        }
        return(
            <div className="row clearfix">
                <Head/>
                <div className="container">
                    <div className="col-md-12">
                        <div>
                            <img src={require(`../assets/img/${book.image}`)} width={100} height={100} />
                        </div>
                        Title: <h4>{book.title}</h4>
                        Author: <h4>{book.author}</h4>
                        Pages: <h4>{book.pages}</h4>
                        Price: <strong>{book.price}$</strong><br/>
                        Description: <p>{book.description}</p>
                    </div>
                    <div className="col-md-12">
                        <button className="btn btn-outline-success" onClick={this._addToCart}>Add to cart</button>
                    </div>
                </div>
            </div>
        );
    }
}