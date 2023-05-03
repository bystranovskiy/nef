const path = require("path");
const NODE_ENV = process.env.NODE_ENV || "development";
const webpack = require("webpack");
const autoprefixer = require("autoprefixer");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const ESLintPlugin = require("eslint-webpack-plugin");
const {CleanWebpackPlugin} = require("clean-webpack-plugin");

const scss  = "./src/scss/sections/";
const js    = "./src/js/sections/";

module.exports = {

    watch: false,

    entry: {
        "main": "./src/entry.es6",

        "admin-styles": "./src/scss/partials/admin-styles.scss",

        "load-more-css":  "./src/js/load-more-css.es6",
        "ajax-pagination":  "./src/js/ajax-pagination.es6",

        "post-item": "./src/scss/partials/post-item.scss",

        "page-search": "./src/scss/pages/page-search.scss",
        "page-nefologism": "./src/js/pages/page-nefologism.es6",
        "page-about-nef": "./src/scss/pages/page-about-nef.scss",

        "error404": "./src/scss/pages/error404.scss",

        "single-post": "./src/js/pages/single-post.es6",
        "single-innovation-cases": "./src/js/pages/single-innovation-cases.es6",
        "single-innovation-agents": "./src/scss/pages/single-innovation-agents.scss",

        "block-categories-list": "./src/scss/sidebar-widgets/block-categories-list.scss",
        "block-innovation-agents": "./src/scss/sidebar-widgets/block-innovation-agents.scss",
        "block-info": "./src/scss/sidebar-widgets/block-info.scss",
        "block-communities": "./src/scss/sidebar-widgets/block-communities.scss",
        "block-activities": "./src/scss/sidebar-widgets/block-activities.scss",
        "block-links": "./src/scss/sidebar-widgets/block-links.scss",
        "block-statistics": "./src/scss/sidebar-widgets/block-statistics.scss",

        "block-content-info": "./src/scss/content-blocks/block-content-info.scss",
        "block-content-cta": "./src/scss/content-blocks/block-content-cta.scss",

        "section-nef-intro": "./src/scss/sections/section-nef-intro.scss",
        "section-nef-cases": "./src/scss/sections/section-nef-cases.scss",
        "section-nef-info": "./src/scss/sections/section-nef-info.scss",
        "section-nef-faq": "./src/js/sections/section-nef-faq.es6",
        "section-nef-analytics": "./src/scss/sections/section-nef-analytics.scss",
        "section-nef-form": "./src/scss/sections/section-nef-form.scss",
    },

    output: {
        path: path.resolve(__dirname, "build"),
        filename: "./[name].min.js"
    },

    plugins: [
        new CleanWebpackPlugin(),
        new webpack.DefinePlugin({
            NODE_ENV: JSON.stringify(NODE_ENV)
        }),
        new webpack.ProvidePlugin({
            Promise: "es6-promise-promise"
        }),
        new MiniCssExtractPlugin({
            filename: "./[name].min.css",
        }),
        new ESLintPlugin({
            extensions: "es6",
        }),
    ],

    module: {

        rules: [
            {
                test: /\.es6$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: "babel-loader",
                    options: {
                        presets: ["@babel/preset-env"]
                    }
                }
            },
            {
                test: /\.s?css$/,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader
                    },
                    {
                        loader: "css-loader",
                        options: {
                            sourceMap: NODE_ENV === "development",
                        }
                    },
                    {
                        loader: "resolve-url-loader",
                        options: {
                            sourceMap: NODE_ENV === "development"
                        }
                    },
                    {
                        loader: "postcss-loader",
                        options: {
                            postcssOptions: {
                                plugins: [
                                    autoprefixer
                                ],
                            },
                            sourceMap: true
                        }
                    },
                    {
                        loader: "sass-loader",
                        options: {
                            sourceMap: true
                        }
                    }
                ],
            },
            {
                test: /\.(jpg|png|woff|woff2|eot|ttf|svg|gif)$/,
                loader: "url-loader",
                options: {
                    limit: 100000,
                }
            }

        ]
    },

    devtool: NODE_ENV === "development" ? "source-map" : false,

    externals: {
        "jquery": "jQuery"
    }

};