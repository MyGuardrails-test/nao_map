var DisplayerModel = function() {
    
    this.displayList = ko.observable(true);
    this.displayMap = ko.observable(false);

    displayOptionMap = function() {
        this.displayMap(true);
        this.displayList(false);
        }

    displayOptionList = function () {
        this.displayMap(false);
        this.displayList(true);   
    }
};
ko.applyBindings(new DisplayerModel());