import React from 'react'

const CommentItem = props => {
    return (
        <div className="row blog-comments">
            <div className="comment">
                <h5><i className="fas fa-user"></i> {props.data.name}</h5>
                <p>{props.data.comment}</p>
                <span>{props.data.created_date}</span>
            </div>
        </div>
    );
};

export default class CommentsList extends React.Component {
    constructor(props) {
        super(props)
    }

    render(){
        let i = 0;
        let comment = [];
        for (length = this.props.data.length; i < length; i++) {
             comment.push(
                 <CommentItem data={this.props.data[i]}/>
             );
        }
        return (
            <div className="row">
                {comment}
            </div>
        );
    }
}