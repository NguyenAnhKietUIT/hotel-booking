function paginationTable(element, pageNumber = 5) {
    $(`table#table-${element}`).each(function() {
        var currentPage = 0;
        var numPerPage = pageNumber;
        var $table = $(this);
        $table.bind('repaginate', function() {
            $table.find('tbody tr:not(tbody tr:first-child)').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
        });
        $table.trigger('repaginate');
        var numRows = $table.find('tbody tr').length;
        var numPages = Math.ceil(numRows / numPerPage);
        var $pager = $('<div class="pager"></div>');
        var $previous = $('<span class="previous"><i class="fa-solid fa-angles-left"></i></span>');
        var $next = $('<span class="next"><i class="fa-solid fa-angles-right"></i></span>');
        for (var page = 0; page < numPages; page++) {
            $(`<span class="page-number-${element}"></span>`).text(page + 1).bind('click', {
                newPage: page
            }, function(event) {
                currentPage = event.data['newPage'];
                $table.trigger('repaginate');
                $(this).addClass('active').siblings().removeClass('active');
            }).appendTo($pager).addClass('clickable');
        }
        $pager.insertAfter($table).find(`span.page-number-${element}:first`).addClass('active');
        $previous.insertBefore(`span.page-number-${element}:first`);
        $next.insertAfter(`span.page-number-${element}:last`);
        
        $next.click(function (e) {
            $previous.addClass('clickable');
            $pager.find('.active').next(`.page-number-${element}.clickable`).click();
        });
        $previous.click(function (e) {
            $next.addClass('clickable');
            $pager.find('.active').prev(`.page-number-${element}.clickable`).click();
        });
        $table.on('repaginate', function () {
            $next.addClass('clickable');
            $previous.addClass('clickable');
            
            setTimeout(function () {
                var $active = $pager.find(`.page-number-${element}.active`);
                if ($active.next(`.page-number-${element}.clickable`).length === 0) {
                    $next.removeClass('clickable');
                } else if ($active.prev(`.page-number-${element}.clickable`).length === 0) {
                    $previous.removeClass('clickable');
                }
            });
        });
        $table.trigger('repaginate');
    });
}