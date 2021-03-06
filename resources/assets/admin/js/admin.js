(function($){
    // enable plugins
    GuideChimp.extend(guideChimpPluginMultiPage);

    var guide = GuideChimp([
        {
            element: '.guide',
            title: 'Start Guided Tour',
            description: 'Start the tour by clicking this menu item. You can also show the tour to all new customers and walk them through the website.',
        },
        {
            element:  '.tile_count',
            title: 'Application Summary',
            description: 'You can use these components to show the current application or customer stats.',
        },
        {
            element:  '#log_activity > .col-md-3',
            title: 'Log Levels',
            description: 'This is a component, which is providing you with information about application logs.',
        }
    ]);

    $('.guided-tour').on('click', function(){
        guide.start();
    });
})(jQuery);
