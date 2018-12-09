'use strict'

const webpack = require('webpack')
const HtmlWebpackPlugin = require('html-webpack-plugin')

module.exports = {
  mode: 'development',
  entry: [
    './src/components/App.jsx'
  ],
  devServer: {
    host: '0.0.0.0',
    hot: true,
    historyApiFallback: true,
    port: 2000
  },
  module: {
    rules: [
      {
        test: /\.jsx$/,
        loader: 'babel-loader'
      },
      {
        test: /\.js$/,
        loader: 'babel-loader'
      },
      {
        test: /\.css$/,
        loaders: [ 'style-loader', 'css-loader', 'stylus-loader' ]
      },
      {
        test: /\.styl$/,
        loaders: [ 'style-loader', 'css-loader', 'stylus-loader' ]
      },
      {
          test: /\.(png|jpg|gif|jpeg)$/,
          use: [
              {
                  loader: 'url-loader',
                  options: {
                      limit: 8192
                  }
              }
          ]
      }
    ]
  },
  plugins: [
    new webpack.HotModuleReplacementPlugin(),
    new HtmlWebpackPlugin({
      filename: 'index.html',
      template: 'index.html',
      inject: true
    })
  ]
}