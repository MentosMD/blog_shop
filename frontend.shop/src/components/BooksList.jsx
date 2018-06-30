import React from 'react'
import axios from 'axios'
import NotificationSystem from 'react-notification-system'
import Select from 'react-select'
import 'react-select/dist/react-select.css';
import Pagination from './Pagination.jsx'
import FormFilter from './forms/FormFilter.jsx'
import * as config from '../config'
import {Link} from 'react-router-dom'
import FilterPrice from './forms/FilterPrice.jsx'

class BookItem extends React.Component
{
    constructor(props)
    {
        super(props);
        this.state = {
            data: this.props.data,
            _notificationSystem: null
        };
        this._addToCart = this._addToCart.bind(this);
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
        this.state._notificationSystem = this.refs.notificationSystem;
    }

    _addToCart()
    {
        window.sessionStorage.setItem(this.state.data.id, JSON.stringify(this.state.data));
        this._addNotification('Successfully added in cart', 'success');
    }

    render()
    {
        let { image, title, price, id } = this.props.data;
        return(
            <div className="row book-item">
                <NotificationSystem ref="notificationSystem" />
                <div className="col-md-4">
                    <img src={require(`../assets/img/${image}`)} width={100} height={100} />
                </div>
                <p>{title}</p>
                <strong className="price">{price}$</strong>
                <div className="row display-flex-end">
                    <Link className="btn btn-outline-primary" style={{marginRight: '10px'}} to={"/book/detail/" + id}>Detail</Link>
                    <button className="btn btn-outline-info" onClick={this._addToCart}>Add To Cart</button>
                </div>
            </div>
        );
    }
}

export default class BooksList extends React.Component
{
    constructor(props)
    {
        super(props);
        this.state = {
            data: [],
            pageOfItems: [],
            title: ''
        };
        this.onChangePage = this.onChangePage.bind(this);
        this._onChange = this._onChange.bind(this);
        this._onSubmit = this._onSubmit.bind(this);
        this._onFilterPrice = this._onFilterPrice.bind(this);
        this._onChangePrice = this._onChangePrice.bind(this);
    }

    componentDidMount()
    {
        axios.get(config.API_BOOKS)
            .then((data) => {
                this.setState({ data: data.data.response });
            }).catch((err) => {
                console.log(err);
            });
    }

    _onChangePrice(e)
    {
        let state = this.state;
        state[e.target.name] = e.target.value;
        this.setState(state);
    }

    _onFilterPrice(e)
    {
        e.preventDefault();
        axios.post(config.API_BOOK_BY_PRICE, {
            priceFrom: this.state.priceFrom,
            priceTo: this.state.priceTo
        })
            .then((data) => {
                console.log(data.data.response);
                this.setState({ data: data.data.response });
            }).catch((err) => {
            console.log(err);
        })
    }

    _onChange(e)
    {
        this.setState({ title: e.target.value });
    }

    _onSubmit(e)
    {
        e.preventDefault();
        axios.post(config.API_BOOK_SEARCH, {title: this.state.title})
             .then((data) => {
                 this.setState({ data: data.data.response });
             }).catch((err) => {
                 console.log(err);
             });
    }

    onChangePage(pageOfItems) {
        // update state with new page of items
        this.setState({ pageOfItems: pageOfItems });
    }

    render()
    {
        let items = [];
        this.state.pageOfItems.map((item) => {
                items.push(
                    <div className="col-md-5">
                        <BookItem data={item} />
                    </div>
                );
        });
        return(
            <div className="row clearfix">
                <FormFilter onChange={this._onChange}
                        onSubmit={this._onSubmit}/>
                <FilterPrice onSubmit={this._onFilterPrice}
                             onChange={this._onChangePrice}/>
                {items}
                <div className="row margin-top-30">
                    <Pagination items={this.state.data} onChangePage={this.onChangePage}/>
                </div>
            </div>
        );
    }
}