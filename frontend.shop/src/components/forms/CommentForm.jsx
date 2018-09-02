import React from 'react'
import Slider from 'rc-slider';
import axios from 'axios';
import createSliderWithTooltip from "rc-slider/es/createSliderWithTooltip";
import * as config from '../../config'
const Range = createSliderWithTooltip(Slider.Range);

import 'rc-slider/assets/index.css';

export default class FilterPrice extends React.Component
{
    constructor(props)
    {
        super(props);
        this.state = {
            price: [0,0],
            min: 0,
            max: 0
        };
        this._onChange = this._onChange.bind(this);
        this._onSubmit = this._onSubmit.bind(this);
    }

    componentDidMount()
    {
        axios.get(config.API_BOOK_PRICE_MIN_MAX)
            .then(data => {
                let res = data.data.response;
                this.setState({
                   min: res.min,
                   max: res.max
                });
            }).catch(err => {});
    }

    _onChange(e)
    {
        this.props.onChange(e);
        this.setState({ price: e });
    }

    _onSubmit(e)
    {
        this.props.onSubmit(e);
    }

    render(){
        let { min, max } = this.state;
        return(
            <div className="row">
                 <div className="container">
                     <form method="post" action="#" onSubmit={this._onSubmit} className="row">
                         <div className="col-md-2">
                             <Range min={min} max={max} defaultValue={[3, 10]} tipFormatter={value => `${value}$`} onChange={this._onChange} />
                         </div>
                         <div className="col-md-2">
                             <button type="submit" className="btn btn-outline-primary">Filter</button>
                         </div>
                     </form>
                 </div>
            </div>
        );
    }
}