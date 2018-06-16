import React from 'react'
import TextField from '../TextField.jsx'
import axios from 'axios'
import * as config from '../../config';

export default class FormFilter extends React.Component
{
    constructor(props)
    {
        super(props);
        this.state = {
            genre: '',
            data: []
        };
        this._onSubmit = this._onSubmit.bind(this);
        this._onChange = this._onChange.bind(this);
        this._selectGenre = this._selectGenre.bind(this);
    }

    componentDidMount()
    {

    }

    _onSubmit(e)
    {
        this.props.onSubmit(e);
    }

    _onChange(e)
    {
        let state = this.state;
        state[e.target.name] = e.target.value;
        this.props.onChange(e);
        this.setState(state);
    }

    _selectGenre(e)
    {
        
        this.setState({ genre: e.value });
    }

    render()
    {
        return(
            <div className="row">
                <form method="POST" onSubmit={this._onSubmit} className="form-filter">
                    <div className="col-md-2">
                        <TextField type="text"
                                   placeholder="Search"
                                   name="search"
                                   value={this.state.search}
                                   onChange={this._onChange}
                        />
                    </div>
                    <button type="submit" className="btn btn-outline-primary margin-top-25">Search</button>
                </form>
            </div>
        );
    }
}