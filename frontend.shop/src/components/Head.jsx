import React from 'react'

export default class Head extends React.Component
{
    constructor(props)
    {
        super(props);
    }

    render()
    {
        return(
            <div className="row clearfix">
                <nav className="row menu">
                    <ul>
                        <li><a href="/">Christian books</a></li>
                        <li><a href="http://localhost:4999/#/" target="_blank">Christian blog</a></li>
                        <li><a href="/shopcart" className="link-shopcart">
                            <i className="fas fa-shopping-bag" style={{fontSize: '25px'}}></i>
                            <h4>{sessionStorage.length > 0 ? sessionStorage.length : null}</h4>
                        </a></li>
                    </ul>
                </nav>
            </div>
        );
    }
}