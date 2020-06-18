(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["admin"],{

/***/ "./node_modules/babel-loader/lib/index.js!./node_modules/vue-loader/lib/index.js?!./resources/js/admin/App.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/admin/App.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n//\n//\n//\n//\n//\n//\n//\n/* harmony default export */ __webpack_exports__[\"default\"] = ({\n  name: 'App',\n\n  mounted() {// console.log(this.token.csrf)\n    // this.csrf_token()\n  }\n\n});\n\n//# sourceURL=webpack:///./resources/js/admin/App.vue?./node_modules/babel-loader/lib!./node_modules/vue-loader/lib??vue-loader-options");

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js!./node_modules/vue-loader/lib/index.js?!./resources/js/admin/components/Modals/ClientModals.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/admin/components/Modals/ClientModals.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n/* harmony default export */ __webpack_exports__[\"default\"] = ({\n  props: {\n    action: String,\n    client: Object,\n    create: Function,\n    update: Function\n  },\n\n  mounted() {\n    console.log('Component mounted.');\n  }\n\n});\n\n//# sourceURL=webpack:///./resources/js/admin/components/Modals/ClientModals.vue?./node_modules/babel-loader/lib!./node_modules/vue-loader/lib??vue-loader-options");

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js!./node_modules/vue-loader/lib/index.js?!./resources/js/admin/pages/Clients.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/admin/pages/Clients.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _components_Modals_ClientModals_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../components/Modals/ClientModals.vue */ \"./resources/js/admin/components/Modals/ClientModals.vue\");\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n\n/* harmony default export */ __webpack_exports__[\"default\"] = ({\n  name: 'Clients',\n  components: {\n    ClientModals: _components_Modals_ClientModals_vue__WEBPACK_IMPORTED_MODULE_0__[\"default\"]\n  },\n\n  data() {\n    return {\n      action: 'create',\n      clients: [],\n      client: {\n        name: '',\n        redirect: '',\n        scope: '',\n        type: 'password'\n      }\n    };\n  },\n\n  mounted() {\n    this.fetchClients();\n  },\n\n  methods: {\n    fetchClients: function () {\n      axios.get(\"http://localhost/laravel-woocommerce/oauth/clients\").then(res => {\n        this.clients = res.data.clients;\n        console.log(this.clients);\n      }).catch(err => console.log(err.response));\n    },\n    reset: function () {\n      this.action = 'create';\n      this.client = {\n        name: '',\n        redirect: '',\n        scope: '',\n        type: 'password'\n      };\n    },\n    create: function () {\n      axios.post(\"http://localhost/laravel-woocommerce/oauth/clients\", this.client).then(res => {\n        this.clients = res.data.clients;\n        this.closeModal();\n      }).catch(err => console.log(err.response));\n    },\n    edit: function (client) {\n      this.action = 'edit';\n      let type = '';\n      console.log(client.personal_access_client);\n\n      if (client.password_client == true) {\n        type = 'password';\n      } else if (client.personal_access_client == true) {\n        type = 'personal_access';\n      } else if (client.authorization_code_client == true) {\n        type = 'authorization_code';\n      }\n\n      this.client = {\n        id: client.id,\n        name: client.name,\n        redirect: client.redirect,\n        scope: client.scope,\n        type: type\n      };\n      console.log(this.client);\n    },\n    update: function () {\n      console.log(\"upodate\");\n      axios.put(\"http://localhost/laravel-woocommerce/oauth/clients\", this.client).then(res => {\n        this.clients = res.data.clients;\n        this.closeModal();\n      }).catch(err => console.log(err.response));\n    },\n    removeClient: function (client) {\n      Swal.fire({\n        title: 'Are you sure?',\n        text: 'You will not be able to recover this Client again',\n        type: 'warning',\n        showCancelButton: true,\n        confirmButtonText: 'Yes, delete it!',\n        cancelButtonText: 'No, keep it'\n      }).then(result => {\n        if (result.value) {\n          let data = {\n            id: client.id\n          };\n          axios.delete(\"http://localhost/laravel-woocommerce/oauth/clients\", {\n            params: data\n          }).then(res => {\n            this.clients = res.data.clients;\n          }).catch(error => console.log(error.response));\n        } else if (result.dismiss === Swal.DismissReason.cancel) {\n          Swal.fire('Cancelled', 'Your imaginary file is safe :)', 'error');\n        }\n      });\n    }\n  }\n});\n\n//# sourceURL=webpack:///./resources/js/admin/pages/Clients.vue?./node_modules/babel-loader/lib!./node_modules/vue-loader/lib??vue-loader-options");

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js!./node_modules/vue-loader/lib/index.js?!./resources/js/admin/pages/Home.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/admin/pages/Home.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n//\n//\n//\n//\n//\n//\n/* harmony default export */ __webpack_exports__[\"default\"] = ({\n  name: 'Home',\n\n  data() {\n    return {\n      msg: 'Welcome to Your Vue.js Admin App'\n    };\n  },\n\n  mounted() {\n    axios.post('/csrf-token').then(res => {\n      console.log(res);\n    }).catch(err => console.log(err));\n  }\n\n});\n\n//# sourceURL=webpack:///./resources/js/admin/pages/Home.vue?./node_modules/babel-loader/lib!./node_modules/vue-loader/lib??vue-loader-options");

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js!./node_modules/vue-loader/lib/index.js?!./resources/js/admin/pages/Settings.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/admin/pages/Settings.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n//\n//\n//\n//\n//\n//\n/* harmony default export */ __webpack_exports__[\"default\"] = ({\n  name: 'Settings',\n\n  data() {\n    return {};\n  }\n\n});\n\n//# sourceURL=webpack:///./resources/js/admin/pages/Settings.vue?./node_modules/babel-loader/lib!./node_modules/vue-loader/lib??vue-loader-options");

/***/ }),

/***/ "./node_modules/mini-css-extract-plugin/dist/loader.js?!./node_modules/css-loader/dist/cjs.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/vue-loader/lib/index.js?!./resources/js/admin/App.vue?vue&type=style&index=0&lang=css&":
/*!**************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/mini-css-extract-plugin/dist/loader.js??ref--6-0!./node_modules/css-loader/dist/cjs.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/admin/App.vue?vue&type=style&index=0&lang=css& ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("// extracted by mini-css-extract-plugin\n\n//# sourceURL=webpack:///./resources/js/admin/App.vue?./node_modules/mini-css-extract-plugin/dist/loader.js??ref--6-0!./node_modules/css-loader/dist/cjs.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/vue-loader/lib??vue-loader-options");

/***/ }),

/***/ "./node_modules/mini-css-extract-plugin/dist/loader.js?!./node_modules/css-loader/dist/cjs.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/vue-loader/lib/index.js?!./resources/js/admin/pages/Clients.vue?vue&type=style&index=0&id=6868804f&lang=css&scoped=true&":
/*!************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/mini-css-extract-plugin/dist/loader.js??ref--6-0!./node_modules/css-loader/dist/cjs.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/admin/pages/Clients.vue?vue&type=style&index=0&id=6868804f&lang=css&scoped=true& ***!
  \************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("// extracted by mini-css-extract-plugin\n\n//# sourceURL=webpack:///./resources/js/admin/pages/Clients.vue?./node_modules/mini-css-extract-plugin/dist/loader.js??ref--6-0!./node_modules/css-loader/dist/cjs.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/vue-loader/lib??vue-loader-options");

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/admin/App.vue?vue&type=template&id=65bd4233&":
/*!*************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/admin/App.vue?vue&type=template&id=65bd4233& ***!
  \*************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"render\", function() { return render; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"staticRenderFns\", function() { return staticRenderFns; });\nvar render = function() {\n  var _vm = this\n  var _h = _vm.$createElement\n  var _c = _vm._self._c || _h\n  return _c(\n    \"div\",\n    { attrs: { id: \"vue-backend-app\" } },\n    [_vm._v(\"\\n\\t\" + _vm._s(_vm.csrf) + \"\\n  \"), _c(\"router-view\")],\n    1\n  )\n}\nvar staticRenderFns = []\nrender._withStripped = true\n\n\n\n//# sourceURL=webpack:///./resources/js/admin/App.vue?./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options");

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/admin/components/Modals/ClientModals.vue?vue&type=template&id=0d00cb42&":
/*!****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/admin/components/Modals/ClientModals.vue?vue&type=template&id=0d00cb42& ***!
  \****************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"render\", function() { return render; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"staticRenderFns\", function() { return staticRenderFns; });\nvar render = function() {\n  var _vm = this\n  var _h = _vm.$createElement\n  var _c = _vm._self._c || _h\n  return _c(\"div\", { staticClass: \"container\" }, [\n    _c(\"div\", { staticClass: \"row justify-content-center\" }, [\n      _c(\n        \"div\",\n        {\n          staticClass: \"modal fade\",\n          attrs: {\n            id: \"createTableModal\",\n            tabindex: \"-1\",\n            role: \"dialog\",\n            \"aria-labelledby\": \"createTableModal\",\n            \"aria-hidden\": \"true\"\n          }\n        },\n        [\n          _c(\n            \"div\",\n            { staticClass: \"modal-dialog\", attrs: { role: \"document\" } },\n            [\n              _c(\"div\", { staticClass: \"modal-content\" }, [\n                _vm._m(0),\n                _vm._v(\" \"),\n                _c(\"div\", { staticClass: \"modal-body\" }, [\n                  _c(\n                    \"table\",\n                    {\n                      staticClass: \"form-table\",\n                      attrs: { role: \"presentation\" }\n                    },\n                    [\n                      _c(\"tbody\", [\n                        _c(\"tr\", [\n                          _vm._m(1),\n                          _vm._v(\" \"),\n                          _c(\"td\", [\n                            _c(\"input\", {\n                              directives: [\n                                {\n                                  name: \"model\",\n                                  rawName: \"v-model\",\n                                  value: _vm.client.name,\n                                  expression: \"client.name\"\n                                }\n                              ],\n                              staticClass: \"regular-text\",\n                              attrs: {\n                                type: \"text\",\n                                id: \"name\",\n                                placeholder: \"ex: CodexShaper\"\n                              },\n                              domProps: { value: _vm.client.name },\n                              on: {\n                                input: function($event) {\n                                  if ($event.target.composing) {\n                                    return\n                                  }\n                                  _vm.$set(\n                                    _vm.client,\n                                    \"name\",\n                                    $event.target.value\n                                  )\n                                }\n                              }\n                            })\n                          ])\n                        ]),\n                        _vm._v(\" \"),\n                        _c(\"tr\", [\n                          _vm._m(2),\n                          _vm._v(\" \"),\n                          _c(\"td\", [\n                            _c(\"input\", {\n                              directives: [\n                                {\n                                  name: \"model\",\n                                  rawName: \"v-model\",\n                                  value: _vm.client.redirect,\n                                  expression: \"client.redirect\"\n                                }\n                              ],\n                              staticClass: \"regular-text\",\n                              attrs: {\n                                type: \"text\",\n                                id: \"redirect\",\n                                placeholder: \"http://localhost\"\n                              },\n                              domProps: { value: _vm.client.redirect },\n                              on: {\n                                input: function($event) {\n                                  if ($event.target.composing) {\n                                    return\n                                  }\n                                  _vm.$set(\n                                    _vm.client,\n                                    \"redirect\",\n                                    $event.target.value\n                                  )\n                                }\n                              }\n                            })\n                          ])\n                        ]),\n                        _vm._v(\" \"),\n                        _c(\"tr\", [\n                          _vm._m(3),\n                          _vm._v(\" \"),\n                          _c(\"td\", [\n                            _c(\"input\", {\n                              directives: [\n                                {\n                                  name: \"model\",\n                                  rawName: \"v-model\",\n                                  value: _vm.client.scope,\n                                  expression: \"client.scope\"\n                                }\n                              ],\n                              staticClass: \"regular-text\",\n                              attrs: {\n                                type: \"text\",\n                                id: \"scope\",\n                                placeholder:\n                                  \"Comma separated ex: create,edit,delete\"\n                              },\n                              domProps: { value: _vm.client.scope },\n                              on: {\n                                input: function($event) {\n                                  if ($event.target.composing) {\n                                    return\n                                  }\n                                  _vm.$set(\n                                    _vm.client,\n                                    \"scope\",\n                                    $event.target.value\n                                  )\n                                }\n                              }\n                            })\n                          ])\n                        ]),\n                        _vm._v(\" \"),\n                        _c(\"tr\", [\n                          _vm._m(4),\n                          _vm._v(\" \"),\n                          _c(\"td\", [\n                            _c(\n                              \"select\",\n                              {\n                                directives: [\n                                  {\n                                    name: \"model\",\n                                    rawName: \"v-model\",\n                                    value: _vm.client.type,\n                                    expression: \"client.type\"\n                                  }\n                                ],\n                                attrs: { id: \"type\" },\n                                on: {\n                                  change: function($event) {\n                                    var $$selectedVal = Array.prototype.filter\n                                      .call($event.target.options, function(o) {\n                                        return o.selected\n                                      })\n                                      .map(function(o) {\n                                        var val =\n                                          \"_value\" in o ? o._value : o.value\n                                        return val\n                                      })\n                                    _vm.$set(\n                                      _vm.client,\n                                      \"type\",\n                                      $event.target.multiple\n                                        ? $$selectedVal\n                                        : $$selectedVal[0]\n                                    )\n                                  }\n                                }\n                              },\n                              [\n                                _c(\n                                  \"option\",\n                                  { attrs: { value: \"authorization_code\" } },\n                                  [_vm._v(\"Authorization Code\")]\n                                ),\n                                _vm._v(\" \"),\n                                _c(\"option\", { attrs: { value: \"password\" } }, [\n                                  _vm._v(\"Password\")\n                                ]),\n                                _vm._v(\" \"),\n                                _c(\n                                  \"option\",\n                                  { attrs: { value: \"personal_access\" } },\n                                  [_vm._v(\"Personal access\")]\n                                )\n                              ]\n                            )\n                          ])\n                        ]),\n                        _vm._v(\" \"),\n                        _c(\"tr\", { staticClass: \"submit\" }, [\n                          _c(\"td\", { staticClass: \"text-left\" }, [\n                            _c(\"input\", {\n                              staticClass: \"btn btn-success\",\n                              attrs: {\n                                type: \"button\",\n                                name: \"submit\",\n                                id: \"submit\",\n                                value:\n                                  _vm.action == \"create\" ? \"Create\" : \"Update\"\n                              },\n                              on: {\n                                click: function($event) {\n                                  $event.preventDefault()\n                                  _vm.action == \"create\"\n                                    ? _vm.create()\n                                    : _vm.update()\n                                }\n                              }\n                            })\n                          ]),\n                          _vm._v(\" \"),\n                          _vm._m(5)\n                        ])\n                      ])\n                    ]\n                  )\n                ])\n              ])\n            ]\n          )\n        ]\n      )\n    ])\n  ])\n}\nvar staticRenderFns = [\n  function() {\n    var _vm = this\n    var _h = _vm.$createElement\n    var _c = _vm._self._c || _h\n    return _c(\"div\", { staticClass: \"modal-header\" }, [\n      _c(\"h4\", { staticClass: \"modal-title font-weight-bold\" }, [\n        _vm._v(\"Create Client\")\n      ]),\n      _vm._v(\" \"),\n      _c(\n        \"button\",\n        {\n          staticClass: \"close\",\n          staticStyle: { color: \"#fff\" },\n          attrs: {\n            type: \"button\",\n            \"data-dismiss\": \"modal\",\n            \"aria-label\": \"Close\"\n          }\n        },\n        [_c(\"span\", { attrs: { \"aria-hidden\": \"true\" } }, [_vm._v(\"×\")])]\n      )\n    ])\n  },\n  function() {\n    var _vm = this\n    var _h = _vm.$createElement\n    var _c = _vm._self._c || _h\n    return _c(\"th\", { attrs: { scope: \"row\" } }, [\n      _c(\"label\", { attrs: { for: \"name\" } }, [_vm._v(\"App Name\")])\n    ])\n  },\n  function() {\n    var _vm = this\n    var _h = _vm.$createElement\n    var _c = _vm._self._c || _h\n    return _c(\"th\", { attrs: { scope: \"row\" } }, [\n      _c(\"label\", { attrs: { for: \"redirect\" } }, [_vm._v(\"Redirect URL\")])\n    ])\n  },\n  function() {\n    var _vm = this\n    var _h = _vm.$createElement\n    var _c = _vm._self._c || _h\n    return _c(\"th\", { attrs: { scope: \"row\" } }, [\n      _c(\"label\", { attrs: { for: \"scope\" } }, [_vm._v(\"Scope\")])\n    ])\n  },\n  function() {\n    var _vm = this\n    var _h = _vm.$createElement\n    var _c = _vm._self._c || _h\n    return _c(\"th\", { attrs: { scope: \"row\" } }, [\n      _c(\"label\", { attrs: { for: \"type\" } }, [_vm._v(\"Type\")])\n    ])\n  },\n  function() {\n    var _vm = this\n    var _h = _vm.$createElement\n    var _c = _vm._self._c || _h\n    return _c(\"td\", { staticClass: \"text-right\" }, [\n      _c(\n        \"button\",\n        {\n          staticClass: \"btn btn-danger\",\n          attrs: { type: \"button\", \"data-dismiss\": \"modal\" }\n        },\n        [_vm._v(\"Close\")]\n      )\n    ])\n  }\n]\nrender._withStripped = true\n\n\n\n//# sourceURL=webpack:///./resources/js/admin/components/Modals/ClientModals.vue?./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options");

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/admin/pages/Clients.vue?vue&type=template&id=6868804f&scoped=true&":
/*!***********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/admin/pages/Clients.vue?vue&type=template&id=6868804f&scoped=true& ***!
  \***********************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"render\", function() { return render; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"staticRenderFns\", function() { return staticRenderFns; });\nvar render = function() {\n  var _vm = this\n  var _h = _vm.$createElement\n  var _c = _vm._self._c || _h\n  return _c(\n    \"div\",\n    { staticClass: \"app-settings\" },\n    [\n      _c(\n        \"a\",\n        {\n          staticClass: \"btn btn-success\",\n          attrs: {\n            href: \"#\",\n            \"data-toggle\": \"modal\",\n            \"data-target\": \"#createTableModal\"\n          },\n          on: {\n            click: function($event) {\n              $event.preventDefault()\n              return _vm.reset($event)\n            }\n          }\n        },\n        [_c(\"i\", { staticClass: \"fas fa-plus\" }), _vm._v(\"Create new client\")]\n      ),\n      _vm._v(\" \"),\n      _c(\n        \"div\",\n        { staticClass: \"clients\" },\n        _vm._l(_vm.clients, function(client, index) {\n          return _c(\n            \"div\",\n            {\n              key: index,\n              staticClass: \"dd-item\",\n              attrs: { \"data-index\": index }\n            },\n            [\n              _c(\"div\", { staticClass: \"btn btn-info btn-block mt-3 d-flex\" }, [\n                _c(\n                  \"a\",\n                  {\n                    staticClass:\n                      \"btn btn-link text-white text-left flex-grow-1\",\n                    attrs: { href: \"#\" },\n                    on: {\n                      click: function($event) {\n                        $event.preventDefault()\n                      }\n                    }\n                  },\n                  [_vm._v(_vm._s(client.name))]\n                ),\n                _vm._v(\" \"),\n                _c(\n                  \"a\",\n                  {\n                    staticClass: \"btn btn-link text-white\",\n                    attrs: {\n                      href: \"#\",\n                      \"data-toggle\": \"collapse\",\n                      href: \"#collapse_\" + index + 1,\n                      title: \"edit\"\n                    }\n                  },\n                  [_vm._v(\"Show\")]\n                ),\n                _vm._v(\" \"),\n                _c(\n                  \"a\",\n                  {\n                    staticClass: \"btn btn-success\",\n                    attrs: {\n                      href: \"#\",\n                      \"data-toggle\": \"modal\",\n                      \"data-target\": \"#createTableModal\"\n                    },\n                    on: {\n                      click: function($event) {\n                        $event.preventDefault()\n                        return _vm.edit(client)\n                      }\n                    }\n                  },\n                  [_c(\"i\", { staticClass: \"fas fa-plus\" }), _vm._v(\"Edit\")]\n                ),\n                _vm._v(\" \"),\n                _c(\n                  \"a\",\n                  {\n                    staticClass: \"btn btn-link text-red text-right\",\n                    attrs: { href: \"#\" },\n                    on: {\n                      click: function($event) {\n                        $event.preventDefault()\n                        return _vm.removeClient(client)\n                      }\n                    }\n                  },\n                  [_vm._v(\"Remove\")]\n                )\n              ]),\n              _vm._v(\" \"),\n              _c(\n                \"div\",\n                {\n                  staticClass: \"collapse\",\n                  attrs: { id: \"collapse_\" + index + 1 }\n                },\n                [\n                  _c(\"div\", { staticClass: \"card card-body\" }, [\n                    _c(\"p\", [\n                      _c(\"span\", [_vm._v(\"App Name\")]),\n                      _vm._v(\" : \"),\n                      _c(\"span\", [_vm._v(_vm._s(client.name))])\n                    ]),\n                    _vm._v(\" \"),\n                    _c(\"p\", [\n                      _c(\"span\", [_vm._v(\"Client ID\")]),\n                      _vm._v(\" : \"),\n                      _c(\"span\", [_vm._v(_vm._s(client.id))])\n                    ]),\n                    _vm._v(\" \"),\n                    _c(\"p\", [\n                      _c(\"span\", [_vm._v(\"Client Secret\")]),\n                      _vm._v(\" : \"),\n                      _c(\"span\", [_vm._v(_vm._s(client.secret))])\n                    ]),\n                    _vm._v(\" \"),\n                    _c(\"p\", [\n                      _c(\"span\", [_vm._v(\"Redurect URL\")]),\n                      _vm._v(\" : \"),\n                      _c(\"span\", [_vm._v(_vm._s(client.redirect))])\n                    ])\n                  ])\n                ]\n              )\n            ]\n          )\n        }),\n        0\n      ),\n      _vm._v(\" \"),\n      _c(\"client-modals\", {\n        attrs: {\n          action: _vm.action,\n          client: _vm.client,\n          create: _vm.create,\n          update: _vm.update\n        }\n      })\n    ],\n    1\n  )\n}\nvar staticRenderFns = []\nrender._withStripped = true\n\n\n\n//# sourceURL=webpack:///./resources/js/admin/pages/Clients.vue?./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options");

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/admin/pages/Home.vue?vue&type=template&id=d7386ab0&scoped=true&":
/*!********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/admin/pages/Home.vue?vue&type=template&id=d7386ab0&scoped=true& ***!
  \********************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"render\", function() { return render; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"staticRenderFns\", function() { return staticRenderFns; });\nvar render = function() {\n  var _vm = this\n  var _h = _vm.$createElement\n  var _c = _vm._self._c || _h\n  return _c(\"div\", { staticClass: \"home\" }, [\n    _c(\"span\", [_vm._v(_vm._s(_vm.msg))])\n  ])\n}\nvar staticRenderFns = []\nrender._withStripped = true\n\n\n\n//# sourceURL=webpack:///./resources/js/admin/pages/Home.vue?./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options");

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/admin/pages/Settings.vue?vue&type=template&id=31dce128&scoped=true&":
/*!************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/admin/pages/Settings.vue?vue&type=template&id=31dce128&scoped=true& ***!
  \************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"render\", function() { return render; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"staticRenderFns\", function() { return staticRenderFns; });\nvar render = function() {\n  var _vm = this\n  var _h = _vm.$createElement\n  var _c = _vm._self._c || _h\n  return _c(\"div\", { staticClass: \"app-settings\" }, [\n    _vm._v(\"\\n  The Settings Page\\n\")\n  ])\n}\nvar staticRenderFns = []\nrender._withStripped = true\n\n\n\n//# sourceURL=webpack:///./resources/js/admin/pages/Settings.vue?./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options");

/***/ }),

/***/ "./resources/js/admin/App.vue":
/*!************************************!*\
  !*** ./resources/js/admin/App.vue ***!
  \************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _App_vue_vue_type_template_id_65bd4233___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./App.vue?vue&type=template&id=65bd4233& */ \"./resources/js/admin/App.vue?vue&type=template&id=65bd4233&\");\n/* harmony import */ var _App_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./App.vue?vue&type=script&lang=js& */ \"./resources/js/admin/App.vue?vue&type=script&lang=js&\");\n/* empty/unused harmony star reexport *//* harmony import */ var _App_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./App.vue?vue&type=style&index=0&lang=css& */ \"./resources/js/admin/App.vue?vue&type=style&index=0&lang=css&\");\n/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ \"./node_modules/vue-loader/lib/runtime/componentNormalizer.js\");\n\n\n\n\n\n\n/* normalize component */\n\nvar component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__[\"default\"])(\n  _App_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__[\"default\"],\n  _App_vue_vue_type_template_id_65bd4233___WEBPACK_IMPORTED_MODULE_0__[\"render\"],\n  _App_vue_vue_type_template_id_65bd4233___WEBPACK_IMPORTED_MODULE_0__[\"staticRenderFns\"],\n  false,\n  null,\n  null,\n  null\n  \n)\n\n/* hot reload */\nif (false) { var api; }\ncomponent.options.__file = \"resources/js/admin/App.vue\"\n/* harmony default export */ __webpack_exports__[\"default\"] = (component.exports);\n\n//# sourceURL=webpack:///./resources/js/admin/App.vue?");

/***/ }),

/***/ "./resources/js/admin/App.vue?vue&type=script&lang=js&":
/*!*************************************************************!*\
  !*** ./resources/js/admin/App.vue?vue&type=script&lang=js& ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_babel_loader_lib_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_App_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib!../../../node_modules/vue-loader/lib??vue-loader-options!./App.vue?vue&type=script&lang=js& */ \"./node_modules/babel-loader/lib/index.js!./node_modules/vue-loader/lib/index.js?!./resources/js/admin/App.vue?vue&type=script&lang=js&\");\n/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__[\"default\"] = (_node_modules_babel_loader_lib_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_App_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__[\"default\"]); \n\n//# sourceURL=webpack:///./resources/js/admin/App.vue?");

/***/ }),

/***/ "./resources/js/admin/App.vue?vue&type=style&index=0&lang=css&":
/*!*********************************************************************!*\
  !*** ./resources/js/admin/App.vue?vue&type=style&index=0&lang=css& ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_mini_css_extract_plugin_dist_loader_js_ref_6_0_node_modules_css_loader_dist_cjs_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_vue_loader_lib_index_js_vue_loader_options_App_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/mini-css-extract-plugin/dist/loader.js??ref--6-0!../../../node_modules/css-loader/dist/cjs.js!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/vue-loader/lib??vue-loader-options!./App.vue?vue&type=style&index=0&lang=css& */ \"./node_modules/mini-css-extract-plugin/dist/loader.js?!./node_modules/css-loader/dist/cjs.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/vue-loader/lib/index.js?!./resources/js/admin/App.vue?vue&type=style&index=0&lang=css&\");\n/* harmony import */ var _node_modules_mini_css_extract_plugin_dist_loader_js_ref_6_0_node_modules_css_loader_dist_cjs_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_vue_loader_lib_index_js_vue_loader_options_App_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_mini_css_extract_plugin_dist_loader_js_ref_6_0_node_modules_css_loader_dist_cjs_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_vue_loader_lib_index_js_vue_loader_options_App_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__);\n/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_mini_css_extract_plugin_dist_loader_js_ref_6_0_node_modules_css_loader_dist_cjs_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_vue_loader_lib_index_js_vue_loader_options_App_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_mini_css_extract_plugin_dist_loader_js_ref_6_0_node_modules_css_loader_dist_cjs_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_vue_loader_lib_index_js_vue_loader_options_App_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));\n /* harmony default export */ __webpack_exports__[\"default\"] = (_node_modules_mini_css_extract_plugin_dist_loader_js_ref_6_0_node_modules_css_loader_dist_cjs_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_vue_loader_lib_index_js_vue_loader_options_App_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); \n\n//# sourceURL=webpack:///./resources/js/admin/App.vue?");

/***/ }),

/***/ "./resources/js/admin/App.vue?vue&type=template&id=65bd4233&":
/*!*******************************************************************!*\
  !*** ./resources/js/admin/App.vue?vue&type=template&id=65bd4233& ***!
  \*******************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_App_vue_vue_type_template_id_65bd4233___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./App.vue?vue&type=template&id=65bd4233& */ \"./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/admin/App.vue?vue&type=template&id=65bd4233&\");\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, \"render\", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_App_vue_vue_type_template_id_65bd4233___WEBPACK_IMPORTED_MODULE_0__[\"render\"]; });\n\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, \"staticRenderFns\", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_App_vue_vue_type_template_id_65bd4233___WEBPACK_IMPORTED_MODULE_0__[\"staticRenderFns\"]; });\n\n\n\n//# sourceURL=webpack:///./resources/js/admin/App.vue?");

/***/ }),

/***/ "./resources/js/admin/components/Modals/ClientModals.vue":
/*!***************************************************************!*\
  !*** ./resources/js/admin/components/Modals/ClientModals.vue ***!
  \***************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _ClientModals_vue_vue_type_template_id_0d00cb42___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ClientModals.vue?vue&type=template&id=0d00cb42& */ \"./resources/js/admin/components/Modals/ClientModals.vue?vue&type=template&id=0d00cb42&\");\n/* harmony import */ var _ClientModals_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ClientModals.vue?vue&type=script&lang=js& */ \"./resources/js/admin/components/Modals/ClientModals.vue?vue&type=script&lang=js&\");\n/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ \"./node_modules/vue-loader/lib/runtime/componentNormalizer.js\");\n\n\n\n\n\n/* normalize component */\n\nvar component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__[\"default\"])(\n  _ClientModals_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__[\"default\"],\n  _ClientModals_vue_vue_type_template_id_0d00cb42___WEBPACK_IMPORTED_MODULE_0__[\"render\"],\n  _ClientModals_vue_vue_type_template_id_0d00cb42___WEBPACK_IMPORTED_MODULE_0__[\"staticRenderFns\"],\n  false,\n  null,\n  null,\n  null\n  \n)\n\n/* hot reload */\nif (false) { var api; }\ncomponent.options.__file = \"resources/js/admin/components/Modals/ClientModals.vue\"\n/* harmony default export */ __webpack_exports__[\"default\"] = (component.exports);\n\n//# sourceURL=webpack:///./resources/js/admin/components/Modals/ClientModals.vue?");

/***/ }),

/***/ "./resources/js/admin/components/Modals/ClientModals.vue?vue&type=script&lang=js&":
/*!****************************************************************************************!*\
  !*** ./resources/js/admin/components/Modals/ClientModals.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_babel_loader_lib_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_ClientModals_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ClientModals.vue?vue&type=script&lang=js& */ \"./node_modules/babel-loader/lib/index.js!./node_modules/vue-loader/lib/index.js?!./resources/js/admin/components/Modals/ClientModals.vue?vue&type=script&lang=js&\");\n/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__[\"default\"] = (_node_modules_babel_loader_lib_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_ClientModals_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__[\"default\"]); \n\n//# sourceURL=webpack:///./resources/js/admin/components/Modals/ClientModals.vue?");

/***/ }),

/***/ "./resources/js/admin/components/Modals/ClientModals.vue?vue&type=template&id=0d00cb42&":
/*!**********************************************************************************************!*\
  !*** ./resources/js/admin/components/Modals/ClientModals.vue?vue&type=template&id=0d00cb42& ***!
  \**********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ClientModals_vue_vue_type_template_id_0d00cb42___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ClientModals.vue?vue&type=template&id=0d00cb42& */ \"./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/admin/components/Modals/ClientModals.vue?vue&type=template&id=0d00cb42&\");\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, \"render\", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ClientModals_vue_vue_type_template_id_0d00cb42___WEBPACK_IMPORTED_MODULE_0__[\"render\"]; });\n\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, \"staticRenderFns\", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ClientModals_vue_vue_type_template_id_0d00cb42___WEBPACK_IMPORTED_MODULE_0__[\"staticRenderFns\"]; });\n\n\n\n//# sourceURL=webpack:///./resources/js/admin/components/Modals/ClientModals.vue?");

/***/ }),

/***/ "./resources/js/admin/main.js":
/*!************************************!*\
  !*** ./resources/js/admin/main.js ***!
  \************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ \"./node_modules/vue/dist/vue.esm.js\");\n/* harmony import */ var _App_vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./App.vue */ \"./resources/js/admin/App.vue\");\n/* harmony import */ var _store__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./store */ \"./resources/js/admin/store/index.js\");\n/* harmony import */ var _router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./router */ \"./resources/js/admin/router/index.js\");\n/* harmony import */ var _utils_admin_menu_fix__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./utils/admin-menu-fix */ \"./resources/js/admin/utils/admin-menu-fix.js\");\n/* harmony import */ var _mixin_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./mixin.js */ \"./resources/js/admin/mixin.js\");\ntry {\n  window.Popper = __webpack_require__(/*! popper.js */ \"./node_modules/popper.js/dist/esm/popper.js\").default;\n  window.$ = window.jQuery = __webpack_require__(/*! jquery */ \"./node_modules/jquery/dist/jquery.js\");\n\n  __webpack_require__(/*! bootstrap */ \"./node_modules/bootstrap/dist/js/bootstrap.js\");\n} catch (e) {}\n/**\n * We'll load the axios HTTP library which allows us to easily issue requests\n * to our Laravel back-end. This library automatically handles sending the\n * CSRF token as a header based on the value of the \"XSRF\" token cookie.\n */\n\n\nwindow.axios = __webpack_require__(/*! axios */ \"./node_modules/axios/index.js\");\nwindow.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';\n/**\n * Next we will register the CSRF Token as a common header with Axios so that\n * all outgoing HTTP requests automatically have it attached. This is just\n * a simple convenience so we don't have to attach every token manually.\n */\n\nlet token = document.querySelector('#wpb-admin');\n\nif (token) {\n  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.getAttribute('csrf-token');\n} else {\n  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');\n}\n\n\n\n\n\n\nwindow.Swal = __webpack_require__(/*! sweetalert2 */ \"./node_modules/sweetalert2/dist/sweetalert2.all.js\");\nvue__WEBPACK_IMPORTED_MODULE_0__[\"default\"].config.productionTip = false;\n\nvue__WEBPACK_IMPORTED_MODULE_0__[\"default\"].mixin(_mixin_js__WEBPACK_IMPORTED_MODULE_5__[\"default\"]);\n/* eslint-disable no-new */\n\nnew vue__WEBPACK_IMPORTED_MODULE_0__[\"default\"]({\n  el: '#wpb-admin',\n  store: _store__WEBPACK_IMPORTED_MODULE_2__[\"default\"],\n  router: _router__WEBPACK_IMPORTED_MODULE_3__[\"default\"],\n  ..._App_vue__WEBPACK_IMPORTED_MODULE_1__[\"default\"]\n}); // fix the admin menu for the slug \"vue-app\"\n\nObject(_utils_admin_menu_fix__WEBPACK_IMPORTED_MODULE_4__[\"default\"])('wp-oauth');\n\n//# sourceURL=webpack:///./resources/js/admin/main.js?");

/***/ }),

/***/ "./resources/js/admin/mixin.js":
/*!*************************************!*\
  !*** ./resources/js/admin/mixin.js ***!
  \*************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\nconst mixin = {\n  data: () => ({\n    token: {\n      csrf: null\n    }\n  }),\n  computed: {\n    csrf: {\n      get() {\n        this.csrf_token().then(res => {\n          this.token.csrf = res.data.csrf_token;\n        });\n        return this.token.csrf;\n      }\n\n    }\n  },\n\n  created() {// this.csrf_token();\n  },\n\n  methods: {\n    async csrf_token() {\n      return axios.get('http://localhost/laravel-woocommerce/csrf-token');\n    },\n\n    closeModal: function () {\n      console.log(\"called\");\n      jQuery('.modal').modal('hide');\n      jQuery('.modal-backdrop').remove();\n    }\n  }\n};\n/* harmony default export */ __webpack_exports__[\"default\"] = (mixin);\n\n//# sourceURL=webpack:///./resources/js/admin/mixin.js?");

/***/ }),

/***/ "./resources/js/admin/pages/Clients.vue":
/*!**********************************************!*\
  !*** ./resources/js/admin/pages/Clients.vue ***!
  \**********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _Clients_vue_vue_type_template_id_6868804f_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Clients.vue?vue&type=template&id=6868804f&scoped=true& */ \"./resources/js/admin/pages/Clients.vue?vue&type=template&id=6868804f&scoped=true&\");\n/* harmony import */ var _Clients_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Clients.vue?vue&type=script&lang=js& */ \"./resources/js/admin/pages/Clients.vue?vue&type=script&lang=js&\");\n/* empty/unused harmony star reexport *//* harmony import */ var _Clients_vue_vue_type_style_index_0_id_6868804f_lang_css_scoped_true___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Clients.vue?vue&type=style&index=0&id=6868804f&lang=css&scoped=true& */ \"./resources/js/admin/pages/Clients.vue?vue&type=style&index=0&id=6868804f&lang=css&scoped=true&\");\n/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ \"./node_modules/vue-loader/lib/runtime/componentNormalizer.js\");\n\n\n\n\n\n\n/* normalize component */\n\nvar component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__[\"default\"])(\n  _Clients_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__[\"default\"],\n  _Clients_vue_vue_type_template_id_6868804f_scoped_true___WEBPACK_IMPORTED_MODULE_0__[\"render\"],\n  _Clients_vue_vue_type_template_id_6868804f_scoped_true___WEBPACK_IMPORTED_MODULE_0__[\"staticRenderFns\"],\n  false,\n  null,\n  \"6868804f\",\n  null\n  \n)\n\n/* hot reload */\nif (false) { var api; }\ncomponent.options.__file = \"resources/js/admin/pages/Clients.vue\"\n/* harmony default export */ __webpack_exports__[\"default\"] = (component.exports);\n\n//# sourceURL=webpack:///./resources/js/admin/pages/Clients.vue?");

/***/ }),

/***/ "./resources/js/admin/pages/Clients.vue?vue&type=script&lang=js&":
/*!***********************************************************************!*\
  !*** ./resources/js/admin/pages/Clients.vue?vue&type=script&lang=js& ***!
  \***********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_babel_loader_lib_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib!../../../../node_modules/vue-loader/lib??vue-loader-options!./Clients.vue?vue&type=script&lang=js& */ \"./node_modules/babel-loader/lib/index.js!./node_modules/vue-loader/lib/index.js?!./resources/js/admin/pages/Clients.vue?vue&type=script&lang=js&\");\n/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__[\"default\"] = (_node_modules_babel_loader_lib_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__[\"default\"]); \n\n//# sourceURL=webpack:///./resources/js/admin/pages/Clients.vue?");

/***/ }),

/***/ "./resources/js/admin/pages/Clients.vue?vue&type=style&index=0&id=6868804f&lang=css&scoped=true&":
/*!*******************************************************************************************************!*\
  !*** ./resources/js/admin/pages/Clients.vue?vue&type=style&index=0&id=6868804f&lang=css&scoped=true& ***!
  \*******************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_mini_css_extract_plugin_dist_loader_js_ref_6_0_node_modules_css_loader_dist_cjs_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_style_index_0_id_6868804f_lang_css_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/mini-css-extract-plugin/dist/loader.js??ref--6-0!../../../../node_modules/css-loader/dist/cjs.js!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/vue-loader/lib??vue-loader-options!./Clients.vue?vue&type=style&index=0&id=6868804f&lang=css&scoped=true& */ \"./node_modules/mini-css-extract-plugin/dist/loader.js?!./node_modules/css-loader/dist/cjs.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/vue-loader/lib/index.js?!./resources/js/admin/pages/Clients.vue?vue&type=style&index=0&id=6868804f&lang=css&scoped=true&\");\n/* harmony import */ var _node_modules_mini_css_extract_plugin_dist_loader_js_ref_6_0_node_modules_css_loader_dist_cjs_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_style_index_0_id_6868804f_lang_css_scoped_true___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_mini_css_extract_plugin_dist_loader_js_ref_6_0_node_modules_css_loader_dist_cjs_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_style_index_0_id_6868804f_lang_css_scoped_true___WEBPACK_IMPORTED_MODULE_0__);\n/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_mini_css_extract_plugin_dist_loader_js_ref_6_0_node_modules_css_loader_dist_cjs_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_style_index_0_id_6868804f_lang_css_scoped_true___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_mini_css_extract_plugin_dist_loader_js_ref_6_0_node_modules_css_loader_dist_cjs_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_style_index_0_id_6868804f_lang_css_scoped_true___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));\n /* harmony default export */ __webpack_exports__[\"default\"] = (_node_modules_mini_css_extract_plugin_dist_loader_js_ref_6_0_node_modules_css_loader_dist_cjs_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_style_index_0_id_6868804f_lang_css_scoped_true___WEBPACK_IMPORTED_MODULE_0___default.a); \n\n//# sourceURL=webpack:///./resources/js/admin/pages/Clients.vue?");

/***/ }),

/***/ "./resources/js/admin/pages/Clients.vue?vue&type=template&id=6868804f&scoped=true&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/admin/pages/Clients.vue?vue&type=template&id=6868804f&scoped=true& ***!
  \*****************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_template_id_6868804f_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./Clients.vue?vue&type=template&id=6868804f&scoped=true& */ \"./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/admin/pages/Clients.vue?vue&type=template&id=6868804f&scoped=true&\");\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, \"render\", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_template_id_6868804f_scoped_true___WEBPACK_IMPORTED_MODULE_0__[\"render\"]; });\n\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, \"staticRenderFns\", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_template_id_6868804f_scoped_true___WEBPACK_IMPORTED_MODULE_0__[\"staticRenderFns\"]; });\n\n\n\n//# sourceURL=webpack:///./resources/js/admin/pages/Clients.vue?");

/***/ }),

/***/ "./resources/js/admin/pages/Home.vue":
/*!*******************************************!*\
  !*** ./resources/js/admin/pages/Home.vue ***!
  \*******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _Home_vue_vue_type_template_id_d7386ab0_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Home.vue?vue&type=template&id=d7386ab0&scoped=true& */ \"./resources/js/admin/pages/Home.vue?vue&type=template&id=d7386ab0&scoped=true&\");\n/* harmony import */ var _Home_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Home.vue?vue&type=script&lang=js& */ \"./resources/js/admin/pages/Home.vue?vue&type=script&lang=js&\");\n/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ \"./node_modules/vue-loader/lib/runtime/componentNormalizer.js\");\n\n\n\n\n\n/* normalize component */\n\nvar component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__[\"default\"])(\n  _Home_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__[\"default\"],\n  _Home_vue_vue_type_template_id_d7386ab0_scoped_true___WEBPACK_IMPORTED_MODULE_0__[\"render\"],\n  _Home_vue_vue_type_template_id_d7386ab0_scoped_true___WEBPACK_IMPORTED_MODULE_0__[\"staticRenderFns\"],\n  false,\n  null,\n  \"d7386ab0\",\n  null\n  \n)\n\n/* hot reload */\nif (false) { var api; }\ncomponent.options.__file = \"resources/js/admin/pages/Home.vue\"\n/* harmony default export */ __webpack_exports__[\"default\"] = (component.exports);\n\n//# sourceURL=webpack:///./resources/js/admin/pages/Home.vue?");

/***/ }),

/***/ "./resources/js/admin/pages/Home.vue?vue&type=script&lang=js&":
/*!********************************************************************!*\
  !*** ./resources/js/admin/pages/Home.vue?vue&type=script&lang=js& ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_babel_loader_lib_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_Home_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib!../../../../node_modules/vue-loader/lib??vue-loader-options!./Home.vue?vue&type=script&lang=js& */ \"./node_modules/babel-loader/lib/index.js!./node_modules/vue-loader/lib/index.js?!./resources/js/admin/pages/Home.vue?vue&type=script&lang=js&\");\n/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__[\"default\"] = (_node_modules_babel_loader_lib_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_Home_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__[\"default\"]); \n\n//# sourceURL=webpack:///./resources/js/admin/pages/Home.vue?");

/***/ }),

/***/ "./resources/js/admin/pages/Home.vue?vue&type=template&id=d7386ab0&scoped=true&":
/*!**************************************************************************************!*\
  !*** ./resources/js/admin/pages/Home.vue?vue&type=template&id=d7386ab0&scoped=true& ***!
  \**************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Home_vue_vue_type_template_id_d7386ab0_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./Home.vue?vue&type=template&id=d7386ab0&scoped=true& */ \"./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/admin/pages/Home.vue?vue&type=template&id=d7386ab0&scoped=true&\");\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, \"render\", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Home_vue_vue_type_template_id_d7386ab0_scoped_true___WEBPACK_IMPORTED_MODULE_0__[\"render\"]; });\n\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, \"staticRenderFns\", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Home_vue_vue_type_template_id_d7386ab0_scoped_true___WEBPACK_IMPORTED_MODULE_0__[\"staticRenderFns\"]; });\n\n\n\n//# sourceURL=webpack:///./resources/js/admin/pages/Home.vue?");

/***/ }),

/***/ "./resources/js/admin/pages/Settings.vue":
/*!***********************************************!*\
  !*** ./resources/js/admin/pages/Settings.vue ***!
  \***********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _Settings_vue_vue_type_template_id_31dce128_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Settings.vue?vue&type=template&id=31dce128&scoped=true& */ \"./resources/js/admin/pages/Settings.vue?vue&type=template&id=31dce128&scoped=true&\");\n/* harmony import */ var _Settings_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Settings.vue?vue&type=script&lang=js& */ \"./resources/js/admin/pages/Settings.vue?vue&type=script&lang=js&\");\n/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ \"./node_modules/vue-loader/lib/runtime/componentNormalizer.js\");\n\n\n\n\n\n/* normalize component */\n\nvar component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__[\"default\"])(\n  _Settings_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__[\"default\"],\n  _Settings_vue_vue_type_template_id_31dce128_scoped_true___WEBPACK_IMPORTED_MODULE_0__[\"render\"],\n  _Settings_vue_vue_type_template_id_31dce128_scoped_true___WEBPACK_IMPORTED_MODULE_0__[\"staticRenderFns\"],\n  false,\n  null,\n  \"31dce128\",\n  null\n  \n)\n\n/* hot reload */\nif (false) { var api; }\ncomponent.options.__file = \"resources/js/admin/pages/Settings.vue\"\n/* harmony default export */ __webpack_exports__[\"default\"] = (component.exports);\n\n//# sourceURL=webpack:///./resources/js/admin/pages/Settings.vue?");

/***/ }),

/***/ "./resources/js/admin/pages/Settings.vue?vue&type=script&lang=js&":
/*!************************************************************************!*\
  !*** ./resources/js/admin/pages/Settings.vue?vue&type=script&lang=js& ***!
  \************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_babel_loader_lib_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_Settings_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib!../../../../node_modules/vue-loader/lib??vue-loader-options!./Settings.vue?vue&type=script&lang=js& */ \"./node_modules/babel-loader/lib/index.js!./node_modules/vue-loader/lib/index.js?!./resources/js/admin/pages/Settings.vue?vue&type=script&lang=js&\");\n/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__[\"default\"] = (_node_modules_babel_loader_lib_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_Settings_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__[\"default\"]); \n\n//# sourceURL=webpack:///./resources/js/admin/pages/Settings.vue?");

/***/ }),

/***/ "./resources/js/admin/pages/Settings.vue?vue&type=template&id=31dce128&scoped=true&":
/*!******************************************************************************************!*\
  !*** ./resources/js/admin/pages/Settings.vue?vue&type=template&id=31dce128&scoped=true& ***!
  \******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Settings_vue_vue_type_template_id_31dce128_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./Settings.vue?vue&type=template&id=31dce128&scoped=true& */ \"./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/admin/pages/Settings.vue?vue&type=template&id=31dce128&scoped=true&\");\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, \"render\", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Settings_vue_vue_type_template_id_31dce128_scoped_true___WEBPACK_IMPORTED_MODULE_0__[\"render\"]; });\n\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, \"staticRenderFns\", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Settings_vue_vue_type_template_id_31dce128_scoped_true___WEBPACK_IMPORTED_MODULE_0__[\"staticRenderFns\"]; });\n\n\n\n//# sourceURL=webpack:///./resources/js/admin/pages/Settings.vue?");

/***/ }),

/***/ "./resources/js/admin/router/index.js":
/*!********************************************!*\
  !*** ./resources/js/admin/router/index.js ***!
  \********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ \"./node_modules/vue/dist/vue.esm.js\");\n/* harmony import */ var vue_router__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vue-router */ \"./node_modules/vue-router/dist/vue-router.esm.js\");\n/* harmony import */ var _pages_Home_vue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../pages/Home.vue */ \"./resources/js/admin/pages/Home.vue\");\n/* harmony import */ var _pages_Settings_vue__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../pages/Settings.vue */ \"./resources/js/admin/pages/Settings.vue\");\n/* harmony import */ var _pages_Clients_vue__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../pages/Clients.vue */ \"./resources/js/admin/pages/Clients.vue\");\n\n\n\n\n\nvue__WEBPACK_IMPORTED_MODULE_0__[\"default\"].use(vue_router__WEBPACK_IMPORTED_MODULE_1__[\"default\"]);\n/* harmony default export */ __webpack_exports__[\"default\"] = (new vue_router__WEBPACK_IMPORTED_MODULE_1__[\"default\"]({\n  routes: [{\n    path: '/',\n    name: 'Home',\n    component: _pages_Home_vue__WEBPACK_IMPORTED_MODULE_2__[\"default\"]\n  }, {\n    path: '/settings',\n    name: 'Settings',\n    component: _pages_Settings_vue__WEBPACK_IMPORTED_MODULE_3__[\"default\"]\n  }, {\n    path: '/clients',\n    name: 'Clients',\n    component: _pages_Clients_vue__WEBPACK_IMPORTED_MODULE_4__[\"default\"]\n  }]\n}));\n\n//# sourceURL=webpack:///./resources/js/admin/router/index.js?");

/***/ }),

/***/ "./resources/js/admin/store/index.js":
/*!*******************************************!*\
  !*** ./resources/js/admin/store/index.js ***!
  \*******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ \"./node_modules/vue/dist/vue.esm.js\");\n/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuex */ \"./node_modules/vuex/dist/vuex.esm.js\");\n\n\nvue__WEBPACK_IMPORTED_MODULE_0__[\"default\"].use(vuex__WEBPACK_IMPORTED_MODULE_1__[\"default\"]); // Load store modules dynamically.\n\nconst requireContext = __webpack_require__(\"./resources/js/admin/store/modules sync .*\\\\.js$\");\n\nconst modules = requireContext.keys().map(file => [file.replace(/(^.\\/)|(\\.js$)/g, ''), requireContext(file)]).reduce((modules, [name, module]) => {\n  if (module.namespaced === undefined) {\n    module.namespaced = true;\n  }\n\n  return { ...modules,\n    [name]: module\n  };\n}, {});\n/* harmony default export */ __webpack_exports__[\"default\"] = (new vuex__WEBPACK_IMPORTED_MODULE_1__[\"default\"].Store({\n  modules\n}));\n\n//# sourceURL=webpack:///./resources/js/admin/store/index.js?");

/***/ }),

/***/ "./resources/js/admin/store/modules sync .*\\.js$":
/*!********************************************************************!*\
  !*** ./resources/js/admin/store/modules sync nonrecursive .*\.js$ ***!
  \********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("var map = {\n\t\"./auth.js\": \"./resources/js/admin/store/modules/auth.js\",\n\t\"./lang.js\": \"./resources/js/admin/store/modules/lang.js\",\n\t\"./upload.js\": \"./resources/js/admin/store/modules/upload.js\"\n};\n\n\nfunction webpackContext(req) {\n\tvar id = webpackContextResolve(req);\n\treturn __webpack_require__(id);\n}\nfunction webpackContextResolve(req) {\n\tif(!__webpack_require__.o(map, req)) {\n\t\tvar e = new Error(\"Cannot find module '\" + req + \"'\");\n\t\te.code = 'MODULE_NOT_FOUND';\n\t\tthrow e;\n\t}\n\treturn map[req];\n}\nwebpackContext.keys = function webpackContextKeys() {\n\treturn Object.keys(map);\n};\nwebpackContext.resolve = webpackContextResolve;\nmodule.exports = webpackContext;\nwebpackContext.id = \"./resources/js/admin/store/modules sync .*\\\\.js$\";\n\n//# sourceURL=webpack:///./resources/js/admin/store/modules_sync_nonrecursive_.*\\.js$?");

/***/ }),

/***/ "./resources/js/admin/store/modules/auth.js":
/*!**************************************************!*\
  !*** ./resources/js/admin/store/modules/auth.js ***!
  \**************************************************/
/*! exports provided: state, getters, mutations, actions */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"state\", function() { return state; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"getters\", function() { return getters; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"mutations\", function() { return mutations; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"actions\", function() { return actions; });\n/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! axios */ \"./node_modules/axios/index.js\");\n/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var js_cookie__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! js-cookie */ \"./node_modules/js-cookie/src/js.cookie.js\");\n/* harmony import */ var js_cookie__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(js_cookie__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var _mutation_types__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../mutation-types */ \"./resources/js/admin/store/mutation-types.js\");\n\n\n // state\n\nconst state = {\n  user: null,\n  token: js_cookie__WEBPACK_IMPORTED_MODULE_1___default.a.get('token')\n}; // getters\n\nconst getters = {\n  user: state => state.user,\n  token: state => state.token,\n  check: state => state.user !== null\n}; // mutations\n\nconst mutations = {\n  [_mutation_types__WEBPACK_IMPORTED_MODULE_2__[\"SAVE_TOKEN\"]](state, {\n    token,\n    remember\n  }) {\n    state.token = token;\n    js_cookie__WEBPACK_IMPORTED_MODULE_1___default.a.set('token', token, {\n      expires: remember ? 365 : null\n    });\n  },\n\n  [_mutation_types__WEBPACK_IMPORTED_MODULE_2__[\"FETCH_USER_SUCCESS\"]](state, {\n    user\n  }) {\n    state.user = user;\n  },\n\n  [_mutation_types__WEBPACK_IMPORTED_MODULE_2__[\"FETCH_USER_FAILURE\"]](state) {\n    state.token = null;\n    js_cookie__WEBPACK_IMPORTED_MODULE_1___default.a.remove('token');\n  },\n\n  [_mutation_types__WEBPACK_IMPORTED_MODULE_2__[\"LOGOUT\"]](state) {\n    state.user = null;\n    state.token = null;\n    js_cookie__WEBPACK_IMPORTED_MODULE_1___default.a.remove('token');\n  },\n\n  [_mutation_types__WEBPACK_IMPORTED_MODULE_2__[\"UPDATE_USER\"]](state, {\n    user\n  }) {\n    state.user = user;\n  }\n\n}; // actions\n\nconst actions = {\n  saveToken({\n    commit,\n    dispatch\n  }, payload) {\n    commit(_mutation_types__WEBPACK_IMPORTED_MODULE_2__[\"SAVE_TOKEN\"], payload);\n  },\n\n  async fetchUser({\n    commit\n  }) {\n    try {\n      const {\n        data\n      } = await axios__WEBPACK_IMPORTED_MODULE_0___default.a.get('/api/user');\n      commit(_mutation_types__WEBPACK_IMPORTED_MODULE_2__[\"FETCH_USER_SUCCESS\"], {\n        user: data\n      });\n    } catch (e) {\n      commit(_mutation_types__WEBPACK_IMPORTED_MODULE_2__[\"FETCH_USER_FAILURE\"]);\n    }\n  },\n\n  updateUser({\n    commit\n  }, payload) {\n    commit(_mutation_types__WEBPACK_IMPORTED_MODULE_2__[\"UPDATE_USER\"], payload);\n  },\n\n  async logout({\n    commit\n  }) {\n    try {\n      // await axios.post('/api/logout')\n      commit(_mutation_types__WEBPACK_IMPORTED_MODULE_2__[\"FETCH_USER_SUCCESS\"], {\n        user: null,\n        token: null\n      });\n    } catch (e) {}\n\n    commit(_mutation_types__WEBPACK_IMPORTED_MODULE_2__[\"LOGOUT\"]);\n  },\n\n  async fetchOauthUrl(ctx, {\n    provider\n  }) {\n    const {\n      data\n    } = await axios__WEBPACK_IMPORTED_MODULE_0___default.a.post(`/api/oauth/${provider}`);\n    return data.url;\n  }\n\n};\n\n//# sourceURL=webpack:///./resources/js/admin/store/modules/auth.js?");

/***/ }),

/***/ "./resources/js/admin/store/modules/lang.js":
/*!**************************************************!*\
  !*** ./resources/js/admin/store/modules/lang.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("// import Cookies from 'js-cookie'\n// import * as types from '../mutation-types'\n// const { locale, locales } = window.config\n// // state\n// export const state = {\n//   locale: Cookies.get('locale') || locale,\n//   locales: locales\n// }\n// // getters\n// export const getters = {\n//   locale: state => state.locale,\n//   locales: state => state.locales\n// }\n// // mutations\n// export const mutations = {\n//   [types.SET_LOCALE] (state, { locale }) {\n//     state.locale = locale\n//   }\n// }\n// // actions\n// export const actions = {\n//   setLocale ({ commit }, { locale }) {\n//     commit(types.SET_LOCALE, { locale })\n//     Cookies.set('locale', locale, { expires: 365 })\n//   }\n// }\n\n//# sourceURL=webpack:///./resources/js/admin/store/modules/lang.js?");

/***/ }),

/***/ "./resources/js/admin/store/modules/upload.js":
/*!****************************************************!*\
  !*** ./resources/js/admin/store/modules/upload.js ***!
  \****************************************************/
/*! exports provided: state, getters, mutations, actions */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"state\", function() { return state; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"getters\", function() { return getters; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"mutations\", function() { return mutations; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"actions\", function() { return actions; });\n/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! axios */ \"./node_modules/axios/index.js\");\n/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var js_cookie__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! js-cookie */ \"./node_modules/js-cookie/src/js.cookie.js\");\n/* harmony import */ var js_cookie__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(js_cookie__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var _mutation_types__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../mutation-types */ \"./resources/js/admin/store/mutation-types.js\");\n\n\n // state\n\nconst state = {\n  code: null,\n  uploader: null\n}; // getters\n\nconst getters = {\n  code: state => state.code,\n  uploader: state => state.uploader\n}; // mutations\n\nconst mutations = {\n  [_mutation_types__WEBPACK_IMPORTED_MODULE_2__[\"CODE_SAVE\"]](state, {\n    code\n  }) {\n    state.code = code;\n  },\n\n  [_mutation_types__WEBPACK_IMPORTED_MODULE_2__[\"CODE_UPDATE\"]](state, {\n    code\n  }) {\n    state.code = code;\n  },\n\n  [_mutation_types__WEBPACK_IMPORTED_MODULE_2__[\"Uploader\"]](state, {\n    uploader\n  }) {\n    state.uploader = uploader;\n  }\n\n}; // actions\n\nconst actions = {\n  saveCode({\n    commit,\n    dispatch\n  }, payload) {\n    commit(_mutation_types__WEBPACK_IMPORTED_MODULE_2__[\"CODE_SAVE\"], payload);\n  },\n\n  updateCode({\n    commit\n  }, payload) {\n    commit(_mutation_types__WEBPACK_IMPORTED_MODULE_2__[\"CODE_UPDATE\"], payload);\n  },\n\n  setUploader: function ({\n    commit,\n    dispatch\n  }, payload) {\n    commit(_mutation_types__WEBPACK_IMPORTED_MODULE_2__[\"Uploader\"], payload);\n  }\n};\n\n//# sourceURL=webpack:///./resources/js/admin/store/modules/upload.js?");

/***/ }),

/***/ "./resources/js/admin/store/mutation-types.js":
/*!****************************************************!*\
  !*** ./resources/js/admin/store/mutation-types.js ***!
  \****************************************************/
/*! exports provided: LOGOUT, SAVE_TOKEN, FETCH_USER, FETCH_USER_SUCCESS, FETCH_USER_FAILURE, UPDATE_USER, SET_LOCALE, CODE_SAVE, CODE_UPDATE, Uploader */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"LOGOUT\", function() { return LOGOUT; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"SAVE_TOKEN\", function() { return SAVE_TOKEN; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"FETCH_USER\", function() { return FETCH_USER; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"FETCH_USER_SUCCESS\", function() { return FETCH_USER_SUCCESS; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"FETCH_USER_FAILURE\", function() { return FETCH_USER_FAILURE; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"UPDATE_USER\", function() { return UPDATE_USER; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"SET_LOCALE\", function() { return SET_LOCALE; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"CODE_SAVE\", function() { return CODE_SAVE; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"CODE_UPDATE\", function() { return CODE_UPDATE; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"Uploader\", function() { return Uploader; });\n// auth.js\nconst LOGOUT = 'LOGOUT';\nconst SAVE_TOKEN = 'SAVE_TOKEN';\nconst FETCH_USER = 'FETCH_USER';\nconst FETCH_USER_SUCCESS = 'FETCH_USER_SUCCESS';\nconst FETCH_USER_FAILURE = 'FETCH_USER_FAILURE';\nconst UPDATE_USER = 'UPDATE_USER'; // lang.js\n\nconst SET_LOCALE = 'SET_LOCALE'; // upload.js\n\nconst CODE_SAVE = 'CODE_SAVE';\nconst CODE_UPDATE = 'CODE_UPDATE';\nconst Uploader = 'Uploader';\n\n//# sourceURL=webpack:///./resources/js/admin/store/mutation-types.js?");

/***/ }),

/***/ "./resources/js/admin/utils/admin-menu-fix.js":
/*!****************************************************!*\
  !*** ./resources/js/admin/utils/admin-menu-fix.js ***!
  \****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/**\n * As we are using hash based navigation, hack fix\n * to highlight the current selected menu\n *\n * Requires jQuery\n */\nfunction menuFix(slug) {\n  var $ = jQuery;\n  let menuRoot = $('#toplevel_page_' + slug);\n  let currentUrl = window.location.href;\n  let currentPath = currentUrl.substr(currentUrl.indexOf('admin.php'));\n  menuRoot.on('click', 'a', function () {\n    var self = $(this);\n    $('ul.wp-submenu li', menuRoot).removeClass('current');\n\n    if (self.hasClass('wp-has-submenu')) {\n      $('li.wp-first-item', menuRoot).addClass('current');\n    } else {\n      self.parents('li').addClass('current');\n    }\n  });\n  $('ul.wp-submenu a', menuRoot).each(function (index, el) {\n    if ($(el).attr('href') === currentPath) {\n      $(el).parent().addClass('current');\n      return;\n    }\n  });\n}\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (menuFix);\n\n//# sourceURL=webpack:///./resources/js/admin/utils/admin-menu-fix.js?");

/***/ })

},[["./resources/js/admin/main.js","runtime","vendors"]]]);