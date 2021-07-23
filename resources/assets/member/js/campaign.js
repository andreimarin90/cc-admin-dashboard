(function ($) {

    let campaignId = 0;
    //let campaignName = '';
    let campaignNewsletters = [];
    let campaignLists = [];
    let modal = $('#newslettersModal');
    //let modalTitleNode = modal.find('.modal-title');
    let modalNewslettersListContainer = modal.find('.newsletters-list');
    let newslettersList = '';
    let isItemPushedToCampaignLists = false;

    $('.newsletter-modal').each(function() {
        modal = $(this);
        modalNewslettersListContainer = modal.find('.newsletters-list');
        campaignId = modal.data('campaign-id');
        //campaignName = $(this).data('campaign-name');
        campaignNewsletters = [];
        campaignLists = [];
        newslettersList = '';

        $.each(window.newsletters, function(index, item) {
        	if (item.campaign_id === campaignId) {
                campaignNewsletters.push(item);
                //newslettersList += '<li>' + item.subject + '</li>';

                isItemPushedToCampaignLists = false;

                $.each(campaignLists, function(index, item2) {
                    if (item.list === item2.listName) {
                        campaignLists[index].newsletters.push(item);
                        isItemPushedToCampaignLists = true;
                    }
                });

                if (!isItemPushedToCampaignLists) campaignLists.push({listName: item.list, newsletters: [item]});
             }
        });

        $.each(campaignLists, function(index, list) {
            newslettersList += '<div class="list-item"><h4 class="list-title">' + list.listName + '</h4>';

            $.each(list.newsletters, function(index, newsletter) {
                newslettersList +=
                    '<div class="list-newsletter">' +
                        '<a class="newsletter-toggle-stats" href="#collapse' + newsletter.id + '" data-toggle="collapse">' + newsletter.subject + '</a>' +

                        '<div class="collapse" id="collapse' + newsletter.id + '">' +
                            '<div class="newsletter-stats">' +
                                '<table>' +
                                    '<tbody>' +
                                        '<tr><td>Campaign channel</td><td>' + newsletter.campaign_channel + '</td></tr>' +
                                        '<tr><td>Campaign list</td><td>' + newsletter.list + '</td></tr>' +
                                        '<tr><td>Campaign identifier</td><td>' + newsletter.campaign_identifier + '</td></tr>' +
                                        '<tr><td>Created at</td><td>' + newsletter.created_at + '</td></tr>' +
                                        '<tr><td>Updated at</td><td>' + newsletter.updated_at + '</td></tr>' +
                                        '<tr><td>Send date</td><td>' + newsletter.send_date + '</td></tr>' +
                                        '<tr><td>Variant</td><td>' + newsletter.variant + '</td></tr>' +
                                        '<tr><td>Weekday</td><td>' + newsletter.week_day + '</td></tr>' +
                                        '<tr><td>Successful deliveries</td><td>' + newsletter.successful_deliveries + '</td></tr>' +
                                        '<tr><td>Total recipients</td><td>' + newsletter.total_recipients + '</td></tr>' +
                                        '<tr><td>Total opens</td><td>' + newsletter.total_opens + '</td></tr>' +
                                        '<tr><td>Unique opens</td><td>' + newsletter.unique_opens + '</td></tr>' +
                                        '<tr><td>Open rate</td><td>' + newsletter.open_rate + '</td></tr>' +
                                        '<tr><td>Total clicks</td><td>' + newsletter.total_clicks + '</td></tr>' +
                                        '<tr><td>Unique clicks</td><td>' + newsletter.unique_clicks + '</td></tr>' +
                                        '<tr><td>Click rate</td><td>' + newsletter.click_rate + '</td></tr>' +
                                        '<tr><td>Unique placed orders</td><td>' + newsletter.unique_placed_orders + '</td></tr>' +
                                        '<tr><td>Placed order rate</td><td>' + newsletter.placed_order_rate + '</td></tr>' +
                                        '<tr><td>Bounces</td><td>' + newsletter.bounces + '</td></tr>' +
                                        '<tr><td>Bounce rate</td><td>' + newsletter.bounce_rate + '</td></tr>' +
                                        '<tr><td>Spam complaints</td><td>' + newsletter.spam_complaints + '</td></tr>' +
                                        '<tr><td>Spam complaints rate</td><td>' + newsletter.spam_complaints_rate + '</td></tr>' +
                                        '<tr><td>Unsubscribes</td><td>' + newsletter.unsubscribes + '</td></tr>' +
                                        '<tr><td>Revenue</td><td>' + newsletter.revenue + '</td></tr>' +
                                        '<tr><td>Winning</td><td>' + newsletter.winning + '</td></tr>' +
                                    '</tbody>' +
                                '</table>' +
                            '</div>' +
                        '</div>' +
                    '</div>';
            });

            newslettersList += '</div>';
        });

        //modalTitleNode.text(campaignName);
        modalNewslettersListContainer.html(newslettersList);

        //modal.modal('show');
    });

    let collapseId = '';

    $('.newsletter-toggle-stats').on('click', function() {
        collapseId = $(this).attr('href');
        $(collapseId).collapse('toggle');
    });

})(jQuery);
