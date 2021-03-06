;(function (window) {

    'use strict';
    console.log('Hello');
    /**
     * Scripts de la page GALERIE pour afficher le detail d'une oeuvre
     * http://www.codrops.com
     *
     * Licensed under the MIT license.
     * http://www.opensource.org/licenses/mit-license.php
     *
     * Copyright 2015, Codrops
     * http://www.codrops.com
     */

    var support = {transitions: Modernizr.csstransitions},
        // transition end event name
        transEndEventNames = {
            'WebkitTransition': 'webkitTransitionEnd',
            'MozTransition': 'transitionend',
            'OTransition': 'oTransitionEnd',
            'msTransition': 'MSTransitionEnd',
            'transition': 'transitionend'
        },
        transEndEventName = transEndEventNames[Modernizr.prefixed('transition')],
        onEndTransition = function (el, callback) {
            var onEndCallbackFn = function (ev) {
                if (support.transitions) {
                    if (ev.target != this) return;
                    this.removeEventListener(transEndEventName, onEndCallbackFn);
                }
                if (callback && typeof callback === 'function') {
                    callback.call(this);
                }
            };
            if (support.transitions) {
                el.addEventListener(transEndEventName, onEndCallbackFn);
            }
            else {
                onEndCallbackFn();
            }
        };

    /**
     * some helper functions
     */

    function throttle(fn, delay) {
        var allowSample = true;

        return function (e) {
            if (allowSample) {
                allowSample = false;
                setTimeout(function () {
                    allowSample = true;
                }, delay);
                fn(e);
            }
        };
    }

    function nextSibling(el) {
        var nextSibling = el.nextSibling;
        while (nextSibling && nextSibling.nodeType != 1) {
            nextSibling = nextSibling.nextSibling
        }
        return nextSibling;
    }

    function extend(a, b) {
        for (var key in b) {
            if (b.hasOwnProperty(key)) {
                a[key] = b[key];
            }
        }
        return a;
    }

    /**
     * GridFx obj
     */
    function GridFx(el, options) {
        this.gridEl = el;
        this.options = extend({}, this.options);
        extend(this.options, options);

        this.items = [].slice.call(this.gridEl.querySelectorAll('.grid__item'));
        this.previewEl = nextSibling(this.gridEl);
        this.isExpanded = false;
        this.isAnimating = false;
        this.closeCtrl = this.previewEl.querySelector('button.action--close');
        this.previewDescriptionEl = this.previewEl.querySelector('.description--preview');

        this._init();
    }

    /**
     * options
     */
    GridFx.prototype.options = {
        pagemargin: 0,
        // x and y can have values from 0 to 1 (percentage). If negative then it means the alignment is left and/or top rather than right and/or bottom
        // so, as an example, if we want our large image to be positioned vertically on 25% of the screen and centered horizontally the values would be x:1,y:-0.25
        imgPosition: {x: 1, y: 1},
        onInit: function (instance) {
            return false;
        },
        onResize: function (instance) {
            return false;
        },
        onOpenItem: function (instance, item) {
            return false;
        },
        onCloseItem: function (instance, item) {
            return false;
        },
        onExpand: function () {
            return false;
        }
    }

    GridFx.prototype._init = function () {
        // callback
        this.options.onInit(this);

        var self = this;
        // init masonry after all images are loaded
        imagesLoaded(this.gridEl, function () {
            // initialize masonry
            new Masonry(self.gridEl, {
                itemSelector: '.grid__item',
                isFitWidth: true
            });
            // show grid after all images (thumbs) are loaded
            classie.add(self.gridEl, 'grid--loaded');
            // init/bind events
            self._initEvents();
            // create the large image and append it to the DOM
            self._setOriginal();
            // create the clone image and append it to the DOM
            self._setClone();
        });
    };

    /**
     * initialize/bind events
     */
    GridFx.prototype._initEvents = function () {
        var self = this,
            clickEvent = (document.ontouchstart !== null ? 'click' : 'touchstart');

        this.items.forEach(function (item) {
            var touchend = function (ev) {
                    ev.preventDefault();
                    self._openItem(ev, item);
                    item.removeEventListener('touchend', touchend);
                },
                touchmove = function (ev) {
                    item.removeEventListener('touchend', touchend);
                },
                manageTouch = function () {
                    item.addEventListener('touchend', touchend);
                    item.addEventListener('touchmove', touchmove);
                };

            item.addEventListener(clickEvent, function (ev) {
                if (clickEvent === 'click') {
                    ev.preventDefault();
                    self._openItem(ev, item);
                }
                else {
                    manageTouch();
                }
            });
        });

        // close expanded image
        this.closeCtrl.addEventListener('click', function () {
            self._closeItem();
        });

        window.addEventListener('resize', throttle(function (ev) {
            // callback
            self.options.onResize(self);
        }, 10));
    }

    /**
     * open a grid item
     */
    GridFx.prototype._openItem = function (ev, item) {
        if (this.isAnimating || this.isExpanded) return;
        this.isAnimating = true;
        this.isExpanded = true;

        // item's image
        var gridImg = item.querySelector('img'),
            gridImgOffset = gridImg.getBoundingClientRect();

        // index of current item
        this.current = this.items.indexOf(item);

        // set the src of the original image element (large image)
        this._setOriginal(item.querySelector('a').getAttribute('href'));

        // callback
        this.options.onOpenItem(this, item);

        // set the clone image
        this._setClone(gridImg.src, {
            width: gridImg.offsetWidth,
            height: gridImg.offsetHeight,
            left: gridImgOffset.left,
            top: gridImgOffset.top
        });

        // hide original grid item
        classie.add(item, 'grid__item--current');

        // calculate the transform value for the clone to animate to the full image view
        var win = this._getWinSize(),
            originalSizeArr = item.getAttribute('data-size').split('x'),
            originalSize = {width: originalSizeArr[0], height: originalSizeArr[1]},
            dx = ((this.options.imgPosition.x > 0 ? 1 - Math.abs(this.options.imgPosition.x) : Math.abs(this.options.imgPosition.x)) * win.width + this.options.imgPosition.x * win.width / 2) - gridImgOffset.left - 0.5 * gridImg.offsetWidth,
            dy = ((this.options.imgPosition.y > 0 ? 1 - Math.abs(this.options.imgPosition.y) : Math.abs(this.options.imgPosition.y)) * win.height + this.options.imgPosition.y * win.height / 2) - gridImgOffset.top - 0.5 * gridImg.offsetHeight,
            z = Math.min(Math.min(win.width * Math.abs(this.options.imgPosition.x) - this.options.pagemargin, originalSize.width - this.options.pagemargin) / gridImg.offsetWidth, Math.min(win.height * Math.abs(this.options.imgPosition.y) - this.options.pagemargin, originalSize.height - this.options.pagemargin) / gridImg.offsetHeight);

        // apply transform to the clone
        this.cloneImg.style.WebkitTransform = 'translate3d(' + dx + 'px, ' + dy + 'px, 0) scale3d(' + z + ', ' + z + ', 1)';
        this.cloneImg.style.transform = 'translate3d(' + dx + 'px, ' + dy + 'px, 0) scale3d(' + z + ', ' + z + ', 1)';

        // add the description if any
        var descriptionEl = item.querySelector('.description');
        if (descriptionEl) {
            this.previewDescriptionEl.innerHTML = descriptionEl.innerHTML;
        }

        var self = this;
        setTimeout(function () {
            // controls the elements inside the expanded view
            classie.add(self.previewEl, 'preview--open');
            // callback
            self.options.onExpand();
        }, 0);

        // after the clone animates..
        onEndTransition(this.cloneImg, function () {
            // when the original/large image is loaded..
            imagesLoaded(self.originalImg, function () {
                // close button just gets shown after the large image gets loaded
                classie.add(self.previewEl, 'preview--image-loaded');
                // animate the opacity to 1
                self.originalImg.style.opacity = 1;
                // and once that's done..
                onEndTransition(self.originalImg, function () {
                    // reset cloneImg
                    self.cloneImg.style.opacity = 0;
                    self.cloneImg.style.WebkitTransform = 'translate3d(0,0,0) scale3d(1,1,1)';
                    self.cloneImg.style.transform = 'translate3d(0,0,0) scale3d(1,1,1)';

                    self.isAnimating = false;
                });

            });
        });
    };

    /**
     * create/set the original/large image element
     */
    GridFx.prototype._setOriginal = function (src) {
        if (!src) {
            this.originalImg = document.createElement('img'); // this.originalImg = document.createElement('img');
            this.originalImg.className = 'original';
            this.originalImg.style.opacity = 0;
            this.originalImg.style.maxWidth = 'calc(' + parseInt(Math.abs(this.options.imgPosition.x) * 100) + 'vw - ' + this.options.pagemargin + 'px)';
            this.originalImg.style.maxHeight = 'calc(' + parseInt(Math.abs(this.options.imgPosition.y) * 100) + 'vh - ' + this.options.pagemargin + 'px)';
            // need it because of firefox
            this.originalImg.style.WebkitTransform = 'translate3d(0,0,0) scale3d(1,1,1)';
            this.originalImg.style.transform = 'translate3d(0,0,0) scale3d(1,1,1)';
            src = '';
            this.previewEl.appendChild(this.originalImg);
        }

        this.originalImg.setAttribute('src', src);
    };

    /**
     * create/set the clone image element
     */
    GridFx.prototype._setClone = function (src, settings) {
        if (!src) {
            this.cloneImg = document.createElement('img');
            this.cloneImg.className = 'clone';
            src = '';
            this.cloneImg.style.opacity = 0;
            this.previewEl.appendChild(this.cloneImg);
        }
        else {
            this.cloneImg.style.opacity = 1;
            // set top/left/width/height of grid item's image to the clone
            this.cloneImg.style.width = settings.width + 'px';
            this.cloneImg.style.height = settings.height + 'px';
            this.cloneImg.style.top = settings.top + 'px';
            this.cloneImg.style.left = settings.left + 'px';
        }

        this.cloneImg.setAttribute('src', src);
    };

    /**
     * closes the original/large image view
     */
    GridFx.prototype._closeItem = function () {
        if (!this.isExpanded || this.isAnimating) return;
        this.isExpanded = false;
        this.isAnimating = true;

        // the grid item's image and its offset
        var gridItem = this.items[this.current],
            gridImg = gridItem.querySelector('img'),
            gridImgOffset = gridImg.getBoundingClientRect(),
            self = this;

        classie.remove(this.previewEl, 'preview--open');
        classie.remove(this.previewEl, 'preview--image-loaded');

        // callback
        this.options.onCloseItem(this, gridItem);

        // large image will animate back to the position of its grid's item
        classie.add(this.originalImg, 'animate');

        // set the transform to the original/large image
        var win = this._getWinSize(),
            dx = gridImgOffset.left + gridImg.offsetWidth / 2 - ((this.options.imgPosition.x > 0 ? 1 - Math.abs(this.options.imgPosition.x) : Math.abs(this.options.imgPosition.x)) * win.width + this.options.imgPosition.x * win.width / 2),
            dy = gridImgOffset.top + gridImg.offsetHeight / 2 - ((this.options.imgPosition.y > 0 ? 1 - Math.abs(this.options.imgPosition.y) : Math.abs(this.options.imgPosition.y)) * win.height + this.options.imgPosition.y * win.height / 2),
            z = gridImg.offsetWidth / this.originalImg.offsetWidth;

        this.originalImg.style.WebkitTransform = 'translate3d(' + dx + 'px, ' + dy + 'px, 0) scale3d(' + z + ', ' + z + ', 1)';
        this.originalImg.style.transform = 'translate3d(' + dx + 'px, ' + dy + 'px, 0) scale3d(' + z + ', ' + z + ', 1)';

        // once that's done..
        onEndTransition(this.originalImg, function () {
            // clear description
            self.previewDescriptionEl.innerHTML = '';

            // show original grid item
            classie.remove(gridItem, 'grid__item--current');

            // fade out the original image
            setTimeout(function () {
                self.originalImg.style.opacity = 0;
            }, 60);

            // and after that
            onEndTransition(self.originalImg, function () {
                // reset original/large image
                classie.remove(self.originalImg, 'animate');
                self.originalImg.style.WebkitTransform = 'translate3d(0,0,0) scale3d(1,1,1)';
                self.originalImg.style.transform = 'translate3d(0,0,0) scale3d(1,1,1)';

                self.isAnimating = false;
            });
        });
    };

    /**
     * gets the window sizes
     */
    GridFx.prototype._getWinSize = function () {
        return {
            width: document.documentElement.clientWidth,
            height: window.innerHeight
        };
    };

    window.GridFx = GridFx;


    /**
     *  Éditeur de texte Tiny MCE - Administration
     */

   tinymce.init({
        selector: 'textarea#tiny',  // change this value according to your HTML
        auto_focus: 'element1',
        plugins: ['image imagetools'],
        language: 'fr_FR'
    });


    /**
     * Fonction de validation de saisie des champs du formulaire de contact
     * @param event
     */

    function valider_formulaire() {
        console.log('Tentative de soumission');
        var form_valid = false;

        // Test du champ PRENOM
        var input_firstname = $('#firstname');
        var firstname_valid = input_firstname.val().trim().length >= 1;
        console.log('Prenom valide : ' + firstname_valid);
        // si la valeur du champ est < a 1 caractere (invalide)
        if (!firstname_valid) {
            form_valid = false;
            input_firstname.addClass('error');
            if (!input_firstname.parent().next('span').next().is('p.error_msg')) {
                input_firstname.parent().next('span').after('<p class="error_msg"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Le prénom doit au moins contenir 1 caractère valide.</p>');
            }
        } else {
            input_firstname.removeClass('error');
            form_valid = true;
            if (input_firstname.parent().next('span').next().is('p.error_msg')) {
                input_firstname.parent().next('span').next().remove();
            }
        }

        // Test du champ NOM
        var input_lastname = $('#lastname');
        var lastname_valid = input_lastname.val().trim().length >= 1;
        console.log('Nom valide : ' + lastname_valid);

        if (!lastname_valid) { // si la valeur du champ est inferieure a 1 caractere
            form_valid = false;
            input_lastname.addClass('error');
            if (!input_lastname.parent().next('span').next().is('p.error_msg')) {
                input_lastname.parent().next('span').after('<p class="error_msg"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Le nom doit au moins contenir 1 caractère valide.</p>');
            }
        } else {
            input_lastname.removeClass('error');
            form_valid = true;
            if (input_lastname.parent().next('span').next().is('p.error_msg')) {
                input_lastname.parent().next('span').next().remove();
            }
        }

        // Test du champ TELEPHONE
        var input_phone = $('#phone');
        var pattern_phone = new RegExp(/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i);
        var exp_rat_phone = new RegExp(pattern_phone, 'g');
        var phone_valid = exp_rat_phone.test(input_phone.val());
        console.log('Telephone valide : ' + phone_valid);

        if (!phone_valid) { // si la valeur du champ n'est pas valide
            form_valid = false;
            input_phone.addClass('error');
            if (!input_phone.parent().next('span').next().is('p.error_msg')) {
                input_phone.parent().next('span').after('<p class="error_msg"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Le telephone doit etre au format XXX-XXX-XXXX.</p>');
            }
        } else {
            input_phone.removeClass('error');
            form_valid = true;
            if (input_phone.parent().next('span').next().is('p.error_msg')) {
                input_phone.parent().next('span').next().remove();
            }
        }

        // Test du champ COURRIEL
        var input_email = $('#email');
        var pattern_email = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
        var exp_rat_email = new RegExp(pattern_email, 'g');// Création d'un objet Javascript RegExp
        var email_valid = exp_rat_email.test(input_email.val());
        console.log('Courriel valide : ' + email_valid);

        if (!email_valid) { // si la valeur du champ n'est pas valide
            form_valid = false;
            input_email.addClass('error');
            if (!input_email.parent().next('span').next().is('p.error_msg')) {
                input_email.parent().next('span').after('<p class="error_msg"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Le courriel doit au moins contenir le caractere @.</p>');
            }
        } else {
            input_email.removeClass('error');
            form_valid = true;
            if (input_email.parent().next('span').next().is('p.error_msg')) {
                input_email.parent().next('span').next().remove();
            }
        }


        // Test du champ SUJET
        var input_subject = $('#subject');
        var subject_valid = input_subject.val().trim().length >= 1;
        console.log('Sujet du message valide : ' + subject_valid);

        if (!subject_valid) { // si la valeur du champ est inferieure a 1 caractere
            form_valid = false;
            input_subject.addClass('error');
            if (!input_subject.parent().next('span').next().is('p.error_msg')) {
                input_subject.parent().next('span').after('<p class="error_msg"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Le sujet doit au moins contenir 1 caractere valide.</p>');
            }
        } else {
            input_subject.removeClass('error');
            form_valid = true;
            if (input_subject.parent().next('span').next().is('p.error_msg')) {
                input_subject.parent().next('span').next().remove();
            }
        }

        // Test du champ MESSAGE
        var textarea_message = $('#message');
        var message_valid = textarea_message.val().trim().length >= 1;
        console.log('Message valide : ' + message_valid);

        if (!message_valid) { // si la valeur du champ est inferieure a 1 caractere
            form_valid = false;
            textarea_message.addClass('error');
            if (!textarea_message.parent().next().is('p.error_msg')) {
                textarea_message.parent().after('<p class="error_msg"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Le message doit au moins contenir 1 caractere valide.</p>');
            }
        } else {
            textarea_message.removeClass('error');
            form_valid = true;
            if (textarea_message.parent().next().is('p.error_msg')) {
                textarea_message.parent().next().remove();
            }
        }

        // Si le formulaire n'est pas valide, on intercepte la soumission
        if (!form_valid) {
            console.log('Soumission interrompue');
            if (e.defaultPrevented) {
                /* Le comportement par défaut a été inhibé */
            }
            //event.preventDefault();

        } else {
            console.log('Soumission reussie');
        }
    }

    $('#contact_submit').on('click', function () {
        valider_formulaire();
    });


})(window);


$(document).ready(function () {
    console.log('DOM construit');

    $('.ico_color_fav').on('click', function () {
        $('#favoris_results').css('display','block');
    });


    /**
     * Fonction Search
     */
    $('#search').on('keyup', function () {
        if ($('#search').val().length > 3) {
            $.getJSON(
                '_controller.php',
                {
                    function: 'search',
                    parameters: ['Everything', $('#search').val()]
                },
                function (data) {
                    $('ul#search_results').empty();
                    if (typeof (data) == 'object') {
                        $.each(data, function (index, search_data) {
                            $('ul#search_results').append('<li class="search_li" id="' + search_data.id + '">');
                            $(search_data.images).each(function (index, image_data) {
                                if (image_data.image_type === 'thumbs') {
                                    $('li#' + search_data.id).append('<img src="' + image_data.image_path + '" alt="' + image_data.content_type + '"/>');
                                }
                            });
                            $('li#' + search_data.id).append('<h3>' + search_data.art_title + '</h3>');
                        });
                    }
                }
            )
        } else {
            $('ul#search_results').empty();
        }
    });

    $('#search').on('focusout', function () {
        $('#search').val('');
        $('ul#search_results').empty();
    });


    /**
     * Fonction Login
     */
    $('#submit_login').on('click', function () {
        var username = $('#username').val();
        var password = $('#password').val();
        $.getJSON(
            '_controller.php',
            {
                function: 'authentication',
                parameters: [username,password]
            },
            function (data) { // data vaut result de la fonction
                console.log(data);
                if (data === 'authenticated') {
                    window.location.replace('administration.php');
                } else {
                    // jQuery du message d'erreur du login
                    window.alert('login failed');
                }
            }
        );
    });

    $('#disconnect').on('click', function () {

        $.getJSON(
            '_controller.php',
            {
                function: 'disconnect',
                parameters: []
            },
            function (data) {
                console.log(data);
                window.location.replace('administration_login.php');
            }
        );
    });





});

