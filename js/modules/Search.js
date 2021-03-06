
import $ from 'jquery';

class Search {
    // 1. describe and create/initiate our object
    constructor() {
        this.addSearchHTML();
        this.openButton = $(".js-search-trigger");
        this.closeButton = $(".search-overlay__close");
        this.searchOverlay = $(".search-overlay");
        this.searchField = $("#search-term");
        this.resultsDiv = $("#search-overlay__results");
        this.events();
        this.isOverlayOpen = false;
        this.isSpinnerVisible = false;
        this.previousValue;
        this.typingTimer;
    }

    // 2. events
    events() {
        this.openButton.on("click", this.openOverlay.bind(this));
        this.closeButton.on("click", this.closeOverlay.bind(this));
        $(document).on("keyup", this.keyPressDispatcher.bind(this));
        this.searchField.on("keyup", this.typingLogic.bind(this));
    }


    // 3. methods (function, action...)

    typingLogic() {

        if (this.searchField.val() != this.previousValue) {
            clearTimeout(this.typingTimer);

            if (this.searchField.val()) {
                if (!this.isSpinnerVisible) {
                    this.resultsDiv.html('<div class="spinner-loader"></div>');
                    this.isSpinnerVisible = true;
                }

                this.typingTimer = setTimeout(this.getResults.bind(this), 750);
            } else {
                this.resultsDiv.html('');
                this.isSpinnerVisible = false;
            }


        }
        this.previousValue = this.searchField.val();


    }

    keyPressDispatcher(e) {
        if (e.keyCode == 83 && !this.isOverlayOpen && $("input, textarea").is(':focus')) {
            this.openOverlay();
        }


        if (e.keyCode == 27 && this.isOverlayOpen) {
            this.closeOverlay();
        }
    }

    getResults() {
        $.getJSON(bakeryData.root_url + '/wp-json/bakeries/v2/search?term=' + this.searchField.val(), (results) => {
            this.resultsDiv.html(`
<div class="row">
    <div class="one-third">
        <h2 class="search-overlay__section-title">General Information</h2>
        ${results.generalInfo.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search.</p>'}
        ${results.generalInfo.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
        ${results.generalInfo.length ? '</ul>' : ''}  
    </div>
    <div class="one-third">
        <h2 class="search-overlay__section-title">Bakes</h2>
        ${results.bakes.length ? '<ul class="link-list min-list">' : `<p>No bakes match that search. <a href="${bakeryData.root_url}/bakes">View all sweet treats</a></p>`}
        ${results.bakes.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
        ${results.bakes.length ? '</ul>' : ''}  
        </div>
     

    <div class="one-third">
        <h2 class="search-overlay__section-title">Locations</h2>
         ${results.locations.length ? '<ul class="link-list min-list">' : `<p>No locations match that search. <a href="${bakeryData.root_url}/locations">View all locations</a></p></p>`}
        ${results.locations.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
        ${results.locations.length ? '</ul>' : ''}  

        <h2 class="search-overlay__section-title">Sales</h2>
        ${results.sales.length ? '' : `<p>No sales match that search. <a href="${bakeryData.root_url}/sales">View all sales</a></p></p>`}
        ${results.sales.map(item => `
        <div class="event-summary">
        <a class="event-summary__date t-center" href="${item.permalink}">
            <span class="event-summary__month">
            ${item.month}
            </span>
            <span class="event-summary__day">
            ${item.day}
            </span>  
        </a>
        <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="${item.permalink}">${item.title}</a></h5>
            <p>${item.description} <a href="${item.permalink}" class="nu gray">See more</a></p>
        </div>
        </div>
        `).join('')}

    </div>
</div>
`);
            this.isSpinnerVisible = false;
        })
    }


    openOverlay() {
        this.searchOverlay.addClass("search-overlay--active");
        $("body").addClass("body-no-scroll");
        this.searchField.val('');
        setTimeout(() => this.searchField.focus(), 301);
        this.isOverlayOpen = true;
        return false;
    }

    closeOverlay() {
        this.searchOverlay.removeClass("search-overlay--active");
        $("body").removeClass("body-no-scroll");
        this.isOverlayOpen = false;
    }



    addSearchHTML() {
        $("body").append(`
        <div class="search-overlay">
        <div class="search-overlay__top">
            <div class="container">
            <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
              <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">
              <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>

            </div>
        </div>

        <div class="container">
          <div id="search-overlay__results">
            
                    </div>
                </div>
            </div>
        `);
    }
}

export default Search;