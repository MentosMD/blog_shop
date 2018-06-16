import React from 'react'
import BooksList from './BooksList.jsx'

export default class MainPage extends React.Component
{
    constructor(props)
    {
        super(props);
        this.state = {}
    }

    render()
    {
        return(
            <div className="row">
                <BooksList/>
            </div>
        );
    }
}