'use strict'

const webpack = require('webpack');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const path = require('path');

module.exports = {
  mode: 'development',
  entry: [
    './src/app.js'
  ],
  devServer: {
      hot: true,
      historyApiFallback: true,
      port: 3000
  },
  module: {
    rules: [
      {
        test: /\.vue$/,
        loader: 'vue-loader'
      },
      {
        test: /\.js$/,
        include: [
              path.resolve(__dirname, "src"),
              require.resolve("bootstrap-vue"),
        ],
        loader: 'babel-loader'
      },
      {
        test: /\.styl$/,
        loaders: [ 'style-loader', 'css-loader', 'stylus-loader' ]
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