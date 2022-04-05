const path = require("path");
const HtmlWebpackPlugin = require("html-webpack-plugin");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");
const VueLoaderPlugin = require("vue-loader/lib/plugin");

module.exports = {
  mode: "production",
  //mode: "development",
  entry: {
    main: "./src/main.js"
  },
  devtool: "inline-source-map",
  plugins: [
    new CleanWebpackPlugin(),
    new HtmlWebpackPlugin({
      title: "Output Management"
    }),
    new VueLoaderPlugin()
    // new JavaScriptObfuscator({}, ['*.vue']),
    /**  new JavaScriptObfuscator({
      rotateUnicodeArray: true
    })*/
  ],
  devServer: {
    contentBase: "./dist"
  },
  output: {
    filename: "build.js",
    path: path.resolve(__dirname, "dist")
  },
  module: {
    rules: [
      {
        test: /\.(graphql|gql)$/,
        exclude: /node_modules/,
        loader: 'graphql-tag/loader',
      },
      {
        test: /\.css$/,
        use: ["style-loader", "css-loader"]
      },
      { test: /\.ts$/, use: "ts-loader" },
      {
        test: /\.js$/,
        loader: "babel-loader",
        include: [path.join(__dirname, "src")]
        //include: [path.join(__dirname, "src")]
      },
      {
        test: /\.vue$/,
        use: [
          {
            loader: "vue-loader",
            options: {
              transpileOptions: {
                transforms: {
                  dangerousTaggedTemplateString: true
                }
              }
            }
          }
        ]
      },
      {
        test: /\.(png|jpe?g|gif)$/i,
        use: [{
          loader: 'file-loader',
        },],
      }
    ]
  },
  resolve: {
    alias: {
      vue$: "vue/dist/vue.esm.js" // 'vue/dist/vue.common.js' for webpack 1
    },
    extensions: ["*", ".js", ".vue", ".json"]
  },
  devServer: {
    historyApiFallback: true,
    noInfo: true,
    overlay: true
  },
  performance: {
    hints: false
  }
  // devtool: "#eval-source-map"
};
