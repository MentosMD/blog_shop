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
            id: this.props.match.params.id,
        };
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

    render()
    {
        let state = this.state;
        if(state.book.image === undefined)
        {
            return null;
        }
        return(
            <div className="row clearfix">
                <Head/>
                <div className="container">
                    <div className="col-md-12">
                        <div>
                            <img src={require(`../assets/img/${state.book.image}`)} width={100} height={100} />
                        </div>
                        Title: <h4>{state.book.title}</h4>
                        Author: <h4>{state.book.author}</h4>
                        Genre: <h4>{state.genre}</h4>
                        Pages: <h4>{state.book.pages}</h4>
                        Price: <strong>{state.book.price}$</strong><br/>
                        Description: <p>{state.book.description}</p>
                    </div>
                </div>
            </div>
        );
    }
}