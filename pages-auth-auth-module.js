(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["pages-auth-auth-module"],{

/***/ "./node_modules/raw-loader/index.js!./src/app/pages/auth/forgot-password/forgot-password.component.html":
/*!*****************************************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/pages/auth/forgot-password/forgot-password.component.html ***!
  \*****************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div class=\"mdl-card mdl-card__blank-layout-card mdl-shadow--2dp\">\n  <div class=\"mdl-card__supporting-text color--dark-gray\">\n    <div class=\"mdl-grid\">\n      <div class=\"mdl-cell mdl-cell--12-col mdl-cell--4-col-phone\">\n        <span class=\"mdl-card__title-text text-color--smooth-gray\">DARKBOARD</span>\n      </div>\n      <div class=\"mdl-cell mdl-cell--12-col mdl-cell--4-col-phone\">\n        <span class=\"blank-layout-card-name text-color--white\">Forgot password?</span>\n        <span class=\"blank-layout-card-secondary-text text-color--smoke\">Enter your email below to recieve your password</span>\n      </div>\n      <div class=\"mdl-cell mdl-cell--12-col mdl-cell--4-col-phone\">\n        <div class=\"mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size\">\n          <input class=\"mdl-textfield__input\" type=\"text\" id=\"e-mail\">\n          <label class=\"mdl-textfield__label\" for=\"e-mail\">Email</label>\n        </div>\n      </div>\n      <div class=\"mdl-cell mdl-cell--12-col mdl-cell--4-col-phone submit-cell\">\n        <div class=\"mdl-layout-spacer\"></div>\n        <a routerLink=\"/app/dashboard\">\n          <button class=\"mdl-button mdl-js-button mdl-button--raised color--light-blue\">\n            SEND PASSWORD\n          </button>\n        </a>\n      </div>\n    </div>\n  </div>\n</div>\n"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/pages/auth/login/login.component.html":
/*!*********************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/pages/auth/login/login.component.html ***!
  \*********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div class=\"mdl-card mdl-card__blank-layout-card mdl-shadow--2dp\">\n  <div class=\"mdl-card__supporting-text color--dark-gray\">\n    <div class=\"mdl-grid\">\n      <div class=\"mdl-cell mdl-cell--12-col mdl-cell--4-col-phone\">\n        <span class=\"mdl-card__title-text text-color--smooth-gray\">DARKBOARD</span>\n      </div>\n      <div class=\"mdl-cell mdl-cell--12-col mdl-cell--4-col-phone\">\n        <span class=\"blank-layout-card-name text-color--white\">Sign in</span>\n        <span class=\"blank-layout-card-secondary-text text-color--smoke\">Enter fields to sign in to DARKBOARD</span><br>\n        <span class=\"blank-layout-card-secondary-text text-color--smoke\">Use the following credentials:</span><br>\n        <span class=\"blank-layout-card-secondary-text text-color--smoke\">user: <strong>admin@admin.admin</strong> , password: <strong>admin</strong></span>\n      </div>\n      <form class=\"login-form\" [formGroup]=\"loginForm\" (submit)=\"login()\" autocomplete=\"off\" novalidate>\n        <div class=\"mdl-cell mdl-cell--12-col mdl-cell--4-col-phone\">\n          <div class=\"mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size\"\n               [class.is-invalid]=\"email.invalid && (email.dirty || email.touched)\"\n               [class.is-valid]=\"email.valid && (email.dirty || email.touched)\">\n            <input formControlName=\"email\"\n                   pattern=\"{{emailPattern}}\"\n                   (change)=\"onInputChange($event)\"\n                   class=\"mdl-textfield__input\" type=\"text\" id=\"email\">\n            <label class=\"mdl-textfield__label\" for=\"email\">Email</label>\n\n            <div *ngIf=\"email.invalid && (email.dirty || email.touched)\">\n              <span *ngIf=\"email.errors.required\" class=\"mdl-textfield__error\">\n                Email is required. <span class=\"color-text--orange\"> Please, write any valid email.</span>\n              </span>\n              <span *ngIf=\"email.errors.pattern\" class=\"mdl-textfield__error\">\n                Email is invalid.\n              </span>\n            </div>\n          </div>\n\n          <div class=\"mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size\"\n               [class.is-invalid]=\"password.invalid && (password.dirty || password.touched)\"\n               [class.is-valid]=\"password.valid && (password.dirty || password.touched)\"\n               id=\"forPass\">\n            <input formControlName=\"password\"\n                   (change)=\"onInputChange($event)\"\n                   class=\"mdl-textfield__input\" type=\"password\" id=\"password\">\n            <label class=\"mdl-textfield__label\" for=\"password\">Password</label>\n            <div *ngIf=\"password.invalid && (password.dirty || password.touched)\">\n              <span *ngIf=\"password.errors.required\" class=\"mdl-textfield__error\">\n                Password is required. <span class=\"color-text--orange\"> Please, write any password.</span>\n              </span>\n            </div>\n          </div>\n\n          <div class=\"full-size color-text--red\" *ngIf=\"error\"> {{ error }}</div>\n\n          <a routerLink=\"/auth/forgot-password\" class=\"blank-layout-card-link\">Forgot password?</a>\n        </div>\n        <div class=\"mdl-cell mdl-cell--12-col mdl-cell--4-col-phone submit-cell\">\n          <a routerLink=\"/auth/sign-up\" class=\"blank-layout-card-link\">Don't have account?</a>\n          <div class=\"mdl-layout-spacer\"></div>\n          <button class=\"mdl-button mdl-js-button mdl-button--raised color--light-blue\"\n                  type=\"submit\" [disabled]=\"loginForm.invalid\">\n            SIGN IN\n          </button>\n        </div>\n      </form>\n    </div>\n  </div>\n</div>\n"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/pages/auth/sign-up/sign-up.component.html":
/*!*************************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/pages/auth/sign-up/sign-up.component.html ***!
  \*************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div class=\"mdl-card mdl-card__blank-layout-card mdl-shadow--2dp\">\n  <div class=\"mdl-card__supporting-text color--dark-gray\">\n    <div class=\"mdl-grid\">\n      <div class=\"mdl-cell mdl-cell--12-col mdl-cell--4-col-phone\">\n        <span class=\"mdl-card__title-text text-color--smooth-gray\">DARKBOARD</span>\n      </div>\n      <div class=\"mdl-cell mdl-cell--12-col mdl-cell--4-col-phone\">\n        <span class=\"blank-layout-card-name text-color--white\">Sign up</span>\n      </div>\n      <div class=\"mdl-cell mdl-cell--12-col mdl-cell--4-col-phone\">\n        <div class=\"mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size\">\n          <input class=\"mdl-textfield__input\" type=\"text\" id=\"name\">\n          <label class=\"mdl-textfield__label\" for=\"name\">Name</label>\n        </div>\n        <div class=\"mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size\">\n          <input class=\"mdl-textfield__input\" type=\"text\" id=\"password\">\n          <label class=\"mdl-textfield__label\" for=\"password\">Password</label>\n        </div>\n        <div class=\"mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size\">\n          <input class=\"mdl-textfield__input\" type=\"text\" id=\"e-mail\">\n          <label class=\"mdl-textfield__label\" for=\"e-mail\">Email</label>\n        </div>\n        <label baseCheckbox color=\"light-blue\" class=\"checkbox--inline\" inline></label>\n        <span class=\"blank-layout-card-link\">I agree all statements in <a href=\"#\" class=\"underlined\">terms of service</a></span>\n      </div>\n      <div class=\"mdl-cell mdl-cell--12-col mdl-cell--4-col-phone submit-cell\">\n        <a routerLink=\"/auth/login\" class=\"blank-layout-card-link\">I have already signed up</a>\n        <div class=\"mdl-layout-spacer\"></div>\n        <a routerLink=\"/app/dashboard\">\n          <button class=\"mdl-button mdl-js-button mdl-button--raised color--light-blue\">\n            SIGN UP\n          </button>\n        </a>\n      </div>\n    </div>\n  </div>\n</div>\n"

/***/ }),

/***/ "./src/app/pages/auth/auth-routing.module.ts":
/*!***************************************************!*\
  !*** ./src/app/pages/auth/auth-routing.module.ts ***!
  \***************************************************/
/*! exports provided: AuthRoutingModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "AuthRoutingModule", function() { return AuthRoutingModule; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm5/router.js");
/* harmony import */ var app_layouts__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! app/layouts */ "./src/app/layouts/index.ts");
/* harmony import */ var app_layouts_blank_layout__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! app/layouts/blank-layout */ "./src/app/layouts/blank-layout/index.ts");
/* harmony import */ var _forgot_password__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./forgot-password */ "./src/app/pages/auth/forgot-password/index.ts");
/* harmony import */ var _login__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./login */ "./src/app/pages/auth/login/index.ts");
/* harmony import */ var _sign_up__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./sign-up */ "./src/app/pages/auth/sign-up/index.ts");
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};







var AuthRoutingModule = /** @class */ (function () {
    function AuthRoutingModule() {
    }
    AuthRoutingModule = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["NgModule"])({
            imports: [
                _angular_router__WEBPACK_IMPORTED_MODULE_1__["RouterModule"].forChild([
                    {
                        path: '',
                        component: app_layouts_blank_layout__WEBPACK_IMPORTED_MODULE_3__["BlankLayoutComponent"],
                        children: [
                            { path: '', redirectTo: 'login', pathMatch: 'full' },
                            { path: 'login', component: _login__WEBPACK_IMPORTED_MODULE_5__["LoginComponent"], pathMatch: 'full' },
                            { path: 'sign-up', component: _sign_up__WEBPACK_IMPORTED_MODULE_6__["SignUpComponent"], pathMatch: 'full' },
                            { path: 'forgot-password', component: _forgot_password__WEBPACK_IMPORTED_MODULE_4__["ForgotPasswordComponent"], pathMatch: 'full' },
                        ],
                    },
                ]),
                app_layouts__WEBPACK_IMPORTED_MODULE_2__["LayoutsModule"],
            ],
            exports: [_angular_router__WEBPACK_IMPORTED_MODULE_1__["RouterModule"]],
        })
    ], AuthRoutingModule);
    return AuthRoutingModule;
}());



/***/ }),

/***/ "./src/app/pages/auth/auth.module.ts":
/*!*******************************************!*\
  !*** ./src/app/pages/auth/auth.module.ts ***!
  \*******************************************/
/*! exports provided: AuthModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "AuthModule", function() { return AuthModule; });
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/common */ "./node_modules/@angular/common/fesm5/common.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/fesm5/forms.js");
/* harmony import */ var theme__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! theme */ "./src/theme/index.ts");
/* harmony import */ var _auth_routing_module__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./auth-routing.module */ "./src/app/pages/auth/auth-routing.module.ts");
/* harmony import */ var _forgot_password__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./forgot-password */ "./src/app/pages/auth/forgot-password/index.ts");
/* harmony import */ var _login__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./login */ "./src/app/pages/auth/login/index.ts");
/* harmony import */ var _sign_up__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./sign-up */ "./src/app/pages/auth/sign-up/index.ts");
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};








var AuthModule = /** @class */ (function () {
    function AuthModule() {
    }
    AuthModule = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
            imports: [
                _angular_common__WEBPACK_IMPORTED_MODULE_0__["CommonModule"],
                theme__WEBPACK_IMPORTED_MODULE_3__["ThemeModule"],
                _auth_routing_module__WEBPACK_IMPORTED_MODULE_4__["AuthRoutingModule"],
                _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormsModule"],
                _angular_forms__WEBPACK_IMPORTED_MODULE_2__["ReactiveFormsModule"],
            ],
            declarations: [
                _login__WEBPACK_IMPORTED_MODULE_6__["LoginComponent"],
                _sign_up__WEBPACK_IMPORTED_MODULE_7__["SignUpComponent"],
                _forgot_password__WEBPACK_IMPORTED_MODULE_5__["ForgotPasswordComponent"],
            ],
        })
    ], AuthModule);
    return AuthModule;
}());



/***/ }),

/***/ "./src/app/pages/auth/forgot-password/forgot-password.component.ts":
/*!*************************************************************************!*\
  !*** ./src/app/pages/auth/forgot-password/forgot-password.component.ts ***!
  \*************************************************************************/
/*! exports provided: ForgotPasswordComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ForgotPasswordComponent", function() { return ForgotPasswordComponent; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var app_components_blank_layout_card__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! app/components/blank-layout-card */ "./src/app/components/blank-layout-card/index.ts");
var __extends = (undefined && undefined.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};


var ForgotPasswordComponent = /** @class */ (function (_super) {
    __extends(ForgotPasswordComponent, _super);
    function ForgotPasswordComponent() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    ForgotPasswordComponent = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"])({
            selector: 'app-forgot-password',
            template: __webpack_require__(/*! raw-loader!./forgot-password.component.html */ "./node_modules/raw-loader/index.js!./src/app/pages/auth/forgot-password/forgot-password.component.html"),
            styles: [__webpack_require__(/*! ../../../components/blank-layout-card/blank-layout-card.component.scss */ "./src/app/components/blank-layout-card/blank-layout-card.component.scss")]
        })
    ], ForgotPasswordComponent);
    return ForgotPasswordComponent;
}(app_components_blank_layout_card__WEBPACK_IMPORTED_MODULE_1__["BlankLayoutCardComponent"]));



/***/ }),

/***/ "./src/app/pages/auth/forgot-password/index.ts":
/*!*****************************************************!*\
  !*** ./src/app/pages/auth/forgot-password/index.ts ***!
  \*****************************************************/
/*! exports provided: ForgotPasswordComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _forgot_password_component__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./forgot-password.component */ "./src/app/pages/auth/forgot-password/forgot-password.component.ts");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "ForgotPasswordComponent", function() { return _forgot_password_component__WEBPACK_IMPORTED_MODULE_0__["ForgotPasswordComponent"]; });




/***/ }),

/***/ "./src/app/pages/auth/login/index.ts":
/*!*******************************************!*\
  !*** ./src/app/pages/auth/login/index.ts ***!
  \*******************************************/
/*! exports provided: LoginComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _login_component__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./login.component */ "./src/app/pages/auth/login/login.component.ts");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "LoginComponent", function() { return _login_component__WEBPACK_IMPORTED_MODULE_0__["LoginComponent"]; });




/***/ }),

/***/ "./src/app/pages/auth/login/login.component.ts":
/*!*****************************************************!*\
  !*** ./src/app/pages/auth/login/login.component.ts ***!
  \*****************************************************/
/*! exports provided: LoginComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "LoginComponent", function() { return LoginComponent; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/fesm5/forms.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm5/router.js");
/* harmony import */ var _services___WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @services/* */ "./src/app/services/index.ts");
/* harmony import */ var app_components_blank_layout_card__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! app/components/blank-layout-card */ "./src/app/components/blank-layout-card/index.ts");
var __extends = (undefined && undefined.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (undefined && undefined.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};





var LoginComponent = /** @class */ (function (_super) {
    __extends(LoginComponent, _super);
    function LoginComponent(authService, fb, router) {
        var _this = _super.call(this) || this;
        _this.authService = authService;
        _this.fb = fb;
        _this.router = router;
        _this.emailPattern = '^([a-zA-Z0-9_\\-\\.]+)@([a-zA-Z0-9_\\-\\.]+)\\.([a-zA-Z]{2,5})$';
        _this.loginForm = _this.fb.group({
            password: new _angular_forms__WEBPACK_IMPORTED_MODULE_1__["FormControl"]('', _angular_forms__WEBPACK_IMPORTED_MODULE_1__["Validators"].required),
            email: new _angular_forms__WEBPACK_IMPORTED_MODULE_1__["FormControl"]('', [
                _angular_forms__WEBPACK_IMPORTED_MODULE_1__["Validators"].required,
                _angular_forms__WEBPACK_IMPORTED_MODULE_1__["Validators"].pattern(_this.emailPattern),
                _angular_forms__WEBPACK_IMPORTED_MODULE_1__["Validators"].maxLength(20),
            ]),
        });
        _this.email = _this.loginForm.get('email');
        _this.password = _this.loginForm.get('password');
        return _this;
    }
    LoginComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.authService.logout();
        this.loginForm.valueChanges.subscribe(function () {
            _this.error = null;
        });
    };
    LoginComponent.prototype.login = function () {
        var _this = this;
        this.error = null;
        if (this.loginForm.valid) {
            this.authService.login(this.loginForm.getRawValue())
                .subscribe(function (res) { return _this.router.navigate(['/app/dashboard']); }, function (error) { return _this.error = error.error.message; });
        }
    };
    LoginComponent.prototype.onInputChange = function (event) {
        event.target.required = true;
    };
    LoginComponent = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"])({
            selector: 'app-login',
            template: __webpack_require__(/*! raw-loader!./login.component.html */ "./node_modules/raw-loader/index.js!./src/app/pages/auth/login/login.component.html"),
            styles: [__webpack_require__(/*! ../../../components/blank-layout-card/blank-layout-card.component.scss */ "./src/app/components/blank-layout-card/blank-layout-card.component.scss")]
        }),
        __metadata("design:paramtypes", [_services___WEBPACK_IMPORTED_MODULE_3__["AuthService"],
            _angular_forms__WEBPACK_IMPORTED_MODULE_1__["FormBuilder"],
            _angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"]])
    ], LoginComponent);
    return LoginComponent;
}(app_components_blank_layout_card__WEBPACK_IMPORTED_MODULE_4__["BlankLayoutCardComponent"]));



/***/ }),

/***/ "./src/app/pages/auth/sign-up/index.ts":
/*!*********************************************!*\
  !*** ./src/app/pages/auth/sign-up/index.ts ***!
  \*********************************************/
/*! exports provided: SignUpComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _sign_up_component__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./sign-up.component */ "./src/app/pages/auth/sign-up/sign-up.component.ts");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "SignUpComponent", function() { return _sign_up_component__WEBPACK_IMPORTED_MODULE_0__["SignUpComponent"]; });




/***/ }),

/***/ "./src/app/pages/auth/sign-up/sign-up.component.ts":
/*!*********************************************************!*\
  !*** ./src/app/pages/auth/sign-up/sign-up.component.ts ***!
  \*********************************************************/
/*! exports provided: SignUpComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "SignUpComponent", function() { return SignUpComponent; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var app_components_blank_layout_card__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! app/components/blank-layout-card */ "./src/app/components/blank-layout-card/index.ts");
var __extends = (undefined && undefined.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};


var SignUpComponent = /** @class */ (function (_super) {
    __extends(SignUpComponent, _super);
    function SignUpComponent() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    SignUpComponent = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"])({
            selector: 'app-sign-up',
            template: __webpack_require__(/*! raw-loader!./sign-up.component.html */ "./node_modules/raw-loader/index.js!./src/app/pages/auth/sign-up/sign-up.component.html"),
            styles: [__webpack_require__(/*! ../../../components/blank-layout-card/blank-layout-card.component.scss */ "./src/app/components/blank-layout-card/blank-layout-card.component.scss")]
        })
    ], SignUpComponent);
    return SignUpComponent;
}(app_components_blank_layout_card__WEBPACK_IMPORTED_MODULE_1__["BlankLayoutCardComponent"]));



/***/ })

}]);
//# sourceMappingURL=pages-auth-auth-module.js.map