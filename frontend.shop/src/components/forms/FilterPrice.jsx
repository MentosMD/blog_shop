import React from 'react'
import TextField from '../TextField.jsx'
import axios from 'axios'
import * as config from '../../config'

export default class FilterPrice extends React.Component
{
    constructor(props)
    {
        super(props);
        this.state = {
            priceFrom: 0,
            priceTo: 0
        };
        this._onChange = this._onChange.bind(this);
        this._onSubmit = this._onSubmit.bind(this);
    }

    _onChange(e)
    {
        let { name, value } = e.target;
        let state = this.state;
        state[name] = value;
        this.props.onChange(e);
        this.setState(state);
    }

    _onSubmit(e)
    {
        this.props.onSubmit(e);
    }

    render(){
        return(
            <div className="row">
                 <div className="container">
                     <form method="post" action="#" onSubmit={this._onSubmit} className="row">
                         <div className="col-md-1">
                             <span>From</span>
                             <TextField type="text"
                                        value={this.state.priceFrom}
                                        name="priceFrom"
                                        onChange={this._onChange}
                             />
                         </div>
                         <div className="col-md-1">
                             <span>To</span>
                             <TextField type="text"
                                        value={this.state.priceTo}
                                        name="priceTo"
                                        onChange={this._onChange}
                             />
                         </div>
                         <div className="col-md-1">
                             <button type="submit" className="btn btn-success">Apply</button>
                         </div>
                     </form>
                 </div>
            </div>
        );
    }
}