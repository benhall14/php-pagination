<?php

namespace benhall14\PHPPagination;

/**
 * PHP Pagination
 *
 * A lightweight PHP pagination class to output pagination links.
 *
 * @author Benjamin Hall <ben@conobe.co.uk>
 *
 */
class Pagination
{
    /**
     * Stores the placeholder for the number count on the URL.
     *
     * @var string
     */
    protected $url_placeholder = '(:num)';

    /**
     * Stores the total number of items in the collection.
     *
     * @var int
     */
    protected $total_items;

    /**
     * Stores the current page number, used to derive the offset.
     *
     * @var int
     */
    protected $page;

    /**
     * Stores the number of items that are returned per page.
     *
     * @var int
     */
    protected $items_per_page = 20;

    /**
     * Stores the URL pattern.
     *
     * @var string
     */
    protected $url_pattern = '?page=(:num)';

    /**
     * Stores the page separator.
     *
     * @var string
     */
    protected $separator = '...';

    /**
     * Stores the size class from Bootstrap 4.
     *
     * @var string
     */
    protected $size = 'pagination-md';

    /**
     * Stores the alignment class from Bootstrap 4.
     *
     * @var string
     */
    protected $align = '';

    /**
     * Stores the hide separator flag.
     *
     * @var boolean
     */
    protected $hide_separator = false;

    /**
     * Stores the "Next Page" text label.
     *
     * @var string
     */
    protected $next_text = 'Next';

    /**
     * Stores the "Previous Page" text label.
     *
     * @var string
     */
    protected $previous_text = 'Previous';

    /**
     * Stores the 'hide next' flag.
     *
     * @var boolean
     */
    protected $hide_next = false;

    /**
     * Stores the 'hide previous' flag.
     *
     * @var boolean
     */
    protected $hide_previous = false;

    /**
     * Stores the 'screen reader' flag. 
     *
     * @var boolean
     */
    protected $screen_reader = true;

    /**
     * Stores the page prefix.
     *
     * (optional) E.g "{prefix} {page_number} {suffix}";
     * @var string
     */
    protected $page_prefix = '';

    /**
     * Stores the page suffix.
     * 
     * (optional) E.g "{prefix} {page_number} {suffix}";
     *
     * @var string
     */
    protected $page_suffix = '';

    /**
     * Stores the number of pages before the separator.
     * 
     * Used to control the number of elements before the separator break.
     *
     * @var integer
     */
    protected $pages_before_separator = 2;

    /**
     * Stores the number of pages surrounding the active page.
     * 
     * Used to control the number of elements surrounding the active page.
     *
     * @var integer
     */
    protected $pages_around_active = 2;

    /**
     * Stores the HTML ID for the navigation element.
     * 
     * (optional)
     *
     * @var string
     */
    protected $navigation_id = '';

    /**
     * Stores the 'retain query string flag', used in URL building.
     *
     * @var boolean
     */
    protected $retain_query_string = false;

    /**
     * Stores the 'fragment query string flag', used in URL building.
     *
     * @var boolean
     */
    protected $fragment_query_string = false;

    /**
     * Stores the generated pagination structure.
     *
     * @var string
     */
    protected $pages = null;
    
    /**
     * Constructor class.
     */
    public function __construct()
    {
        $this->page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
    }

    /**
     * Sets the total number of items in the collection.
     *
     * @param int $total
     * 
     * @return PHPPagination
     */
    public function total($total)
    {
        $this->total_items = (int) $total;

        return $this;
    }

    /**
     * Sets the number of items per page.
     *
     * @param int $items_per_page
     *
     * @return PHPPagination
     */
    public function perPage($items_per_page)
    {
        $this->items_per_page = (int) $items_per_page;

        return $this;
    }

    /**
     * Replaces the default separator with the supplied.
     *
     * @param string $separator
     * @return PHPPagination
     */
    public function separator($separator)
    {
        $this->separator = $separator;

        return $this;
    }

    /**
     * Updates the screen reader option.
     * 
     * True to show the screen reader div or false to remove it
     *
     * @param bool $value
     * @return PHPPagination
     */
    public function screenReader($value)
    {
        $this->screen_reader = $value;

        return $this;
    }

    /**
     * Sets the Bootstrap 4 class to small.
     *
     * @return PHPPagination
     */
    public function small()
    {
        $this->size = 'pagination-sm';

        return $this;
    }

    /**
     * Sets the Bootstrap 4 class to medium.
     *
     * @return PHPPagination
     */
    public function medium()
    {
        $this->size = 'pagination-md';

        return $this;
    }

    /**
     * Sets the Bootstrap 4 class to large.
     *
     * @return PHPPagination
     */
    public function large()
    {
        $this->size = 'pagination-lg';

        return $this;
    }
        
    /**
     * Sets the Bootstrap 4 alignment class to left.
     *
     * @return PHPPagination
     */
    public function alignLeft()
    {
        $this->align = 'justify-content-start';

        return $this;
    }

    /**
     * Sets the Bootstrap 4 alignment class to center.
     *
     * @return PHPPagination
     */
    public function alignCenter()
    {
        $this->align = 'justify-content-center';

        return $this;
    }

    /**
     * Sets the Bootstrap 4 alignment class to right.
     *
     * @return PHPPagination
     */
    public function alignRight()
    {
        $this->align = 'justify-content-end';

        return $this;
    }

    /**
     * Sets the show separator flag to true.
     * 
     * Shows the separator blocks.
     *
     * @return PHPPagination
     */
    public function showSeparator()
    {
        $this->show_separator = true;

        return $this;
    }

    /**
     * Sets the show separator flag to false.
     * 
     * Hides the separator blocks.
     *
     * @return PHPPagination
     */
    public function hideSeparator()
    {
        $this->hide_separator = true;

        return $this;
    }

    /**
     * Overrides the default 'Next Page' text.
     *
     * @param string $next
     * 
     * @return PHPPagination
     */
    public function nextText($next)
    {
        $this->next_text = $next;

        return $this;
    }

    /**
     * Overrides the default 'Previous Page' text.
     *
     * @param string $previous
     * 
     * @return PHPPagination
     */
    public function previousText($previous)
    {
        $this->previous_text = $previous;

        return $this;
    }

    /**
     * Sets the 'hide next' flag to true.
     * 
     * Hides the 'Next Page' link.
     *
     * @return PHPPagination
     */
    public function hideNext()
    {
        $this->hide_next = true;

        return $this;
    }

    /**
     * Sets the 'hide next' flag to false.
     * 
     * Shows the 'Next Page' link. This is the default action.
     *
     * @return PHPPagination
     */
    public function showNext()
    {
        $this->hide_next = false;

        return $this;
    }

    /**
     * Sets the 'hide previous' flag to true;
     * 
     * Hides the 'Previous Page' link.
     *
     * @return PHPPagination
     */
    public function hidePrevious()
    {
        $this->hide_previous = true;

        return $this;
    }

    /**
     * Sets the 'hide previous' flag to false.
     * 
     * Shows the 'Previous Page' link.
     *
     * @return PHPPagination
     */
    public function showPrevious()
    {
        $this->hide_previous = false;

        return $this;
    }

    /**
     * Sets the custom prefix used on page names.
     *
     * @param string $prefix
     * 
     * @return PHPPagination
     */
    public function pagePrefix($prefix)
    {
        $this->page_prefix = $prefix;

        return $this;
    }

    /**
     * Sets the custom suffix used on the page names.
     *
     * @param string $suffix
     * 
     * @return PHPPagination
     */
    public function pageSuffix($suffix)
    {
        $this->page_suffix = $suffix;

        return $this;
    }

    /**
     * Sets the 'retain query string' flag to true.
     *
     * @return PHPPagination
     */
    public function retainQueryString()
    {
        $this->retain_query_string = true;

        return $this;
    }

    /**
     * Sets the 'retain query string' flag to false.
     *
     * @return PHPPagination
     */
    public function dismissQueryString()
    {
        $this->retain_query_string = false;

        return $this;
    }

    /**
     * Sets the custom fragment used in links.
     *
     * @param string $fragment
     *
     * @return PHPPagination
     */
    public function fragmentQueryString($fragment)
    {
        $this->fragment_query_string = $fragment;

        return $this;
    }

    /**
     * Sets the number of pages before an separator element is created.
     *
     * @param int $pages_before_separator
     * 
     * @return PHPPagination
     */
    public function pagesBeforeSeparator($pages_before_separator)
    {
        $this->pages_before_separator = (int) $pages_before_separator;

        return $this;
    }

    /**
     * Sets the number of pages surrounding the active element.
     *
     * @param int $pages_around_active
     * 
     * @return PHPPagination
     */
    public function pagesAroundActive($pages_around_active)
    {
        $this->pages_around_active = (int) $pages_around_active;

        return $this;
    }

    /**
     * Sets the current page number.
     *
     * @param int $current_page_num
     * 
     * @return PHPPagination
     */
    public function page($current_page_num)
    {
        $current_page_num = (int) $current_page_num;
        if ($current_page_num < 1) {
            $current_page_num = 1;
        }

        $this->page = (int) $current_page_num;

        return $this;
    }

    /**
     * Sets the URL pattern for the pagination.
     *
     * @param string $pattern
     * 
     * @return PHPPagination
     */
    public function pattern($pattern, $replacement = false)
    {
        $this->url_pattern = (string) $pattern;

        if ($replacement) {
            $this->url_placeholder = $replacement;
        }

        return $this;
    }

    /**
     * Creates a URL using the defined pattern and placeholder.
     *
     * @param int $page
     * 
     * @return string
     */
    protected function buildURL($page)
    {
        $url = str_replace($this->url_placeholder, $page, $this->url_pattern);

        if ($this->retain_query_string) {
            $query_strings = $_GET;
            if (isset($query_strings['page'])) {
                unset($query_strings['page']);
            }

            $url_separator = (strpos($url, '?') !== false) ? '&' : '?';

            $url .= $url_separator . http_build_query($query_strings);

            $url = trim($url, '&');
        }

        if ($this->fragment_query_string) {
            $url .= '#'.$this->fragment_query_string;
        }

        return $url;
    }

    /**
     * Builds the array for each page.
     *
     * @param string $page
     * @param string $url
     * @param string $text
     * @param string $status
     * 
     * @return array
     */
    protected function pageArray($page, $text, $context = 'page')
    {
        return [
            'page' => $page,
            'url' => $page != null ? $this->buildURL($page) : null,
            'text' => $text,
            'context' => ($this->page == $page) ? 'current' : $context
        ];
    }

    /**
     * Returns the page text name with the prefix/suffix applied.
     *
     * @param string $page_text
     * 
     * @return string
     */
    protected function pageText($page_text)
    {
        return $this->page_prefix . $page_text . $this->page_suffix;
    }

    /**
     * Generates the pagination structure and saves it to the 'pagination' property.
     *
     * @return array
     */
    protected function generate()
    {
        $this->total_pages = $this->items_per_page != 0 ? ceil($this->total_items / $this->items_per_page) : 0;

        if ($this->total_pages <= 1) {
            $this->pages = [];

            return $this->pages;
        }

        $pages = [];
        $this->pages = [];
        $this->prev_page = $this->page - 1;
        $this->next_page = $this->page + 1;

        $this->prev_page = $this->prev_page > 0 ? $this->prev_page : 0;
        $this->next_page = $this->next_page <= $this->total_pages ? $this->next_page : 0;
        $this->first_page = 1;
        $this->last_page = $this->total_pages;

        $this->start_offset = ($this->page - $this->pages_around_active) > 0 ? $this->page - $this->pages_around_active : $this->first_page;
        $this->end_offset = ($this->page + $this->pages_around_active) < $this->total_pages ? $this->page + $this->pages_around_active : $this->last_page;

        if ((($this->pages_before_separator * 2) + $this->pages_before_separator) >= $this->last_page) {
            $this->hide_separator = true;
        }

        if (!$this->hide_previous) {
            if ($this->prev_page) {
                $this->pages[] = $this->pageArray($this->prev_page, $this->previous_text, 'prev');
            }
        }

        if ($this->start_offset >= $this->pages_before_separator) {
            for ($i = 1; $i <= $this->pages_before_separator; $i++) {
                $this->pages[] = $this->pageArray($i, $this->pageText($i));
                $pages[] = $i;
            }

            if (!$this->hide_separator) {
                $this->pages[] = $this->pageArray(null, $this->separator, 'separator');
            }
        }

        for ($i = $this->start_offset; $i <= $this->end_offset; $i++) {
            if (!in_array($i, $pages)) {
                $this->pages[] = $this->pageArray($i, $this->pageText($i));
            }
        }

        if ($this->end_offset <= ($this->last_page - $this->pages_before_separator)) {
            if (!$this->hide_separator) {
                $this->pages[] = $this->pageArray(null, $this->separator, 'separator');
            }

            for ($i = ($this->last_page - ($this->pages_before_separator - 1)); $i <= $this->last_page; $i++) {
                $this->pages[] = $this->pageArray($i, $this->pageText($i));
            }
        }

        if ($i == $this->last_page) {
            $this->pages[] = $this->pageArray($i, $this->pageText($i));
        }

        if (!$this->hide_next) {
            if ($this->next_page) {
                $this->pages[] = $this->pageArray($this->next_page, $this->next_text, 'next');
            }
        }

        return $this->pages;
    }

    /**
     * Generates and returns the generated pagination structure.
     *
     * @return string The pagination structure.
     */
    public function get()
    {
        if ($this->pages === null) {
            $this->generate();
        }

        $navigation_id = $this->navigation_id ? ' id="' . $this->navigation_id . '"' : '';

        $output = '<nav' . $navigation_id . ' class="' . $this->size . '" aria-label="Navigation">';
        $output .= "\r\n";
        $output .= '<ul class="pagination ' . $this->align . '">';
        $output .= "\r\n";
        foreach ($this->pages as $page) {
            $page_item_class = $page['page'] ? $page['page'] : 'separator';
            $page_link_class = $page['page'] ? $page['page'] : 'separator';
            $page_disabled_class = !$page['page'] ? ' disabled' : '';

            switch ($page['context']) {
                case 'prev':
                    $output .= '<li class="page-item page-item-' . $page_item_class . ' page-prev' . $page_disabled_class . '">';
                    $output .= '<a aria-label="' . $page['text'] . '" class="page-link page-link-' . $page_link_class . ' page-link-prev" href="' . $page['url'] . '">';
                    $output .= '<span aria-hidden="true">' . $page['text'] . '</span>';
                    if ($this->screen_reader) {
                        $output .= '<span class="sr-only">' . $page['text'] . '</span>';
                    }
                    $output .= '</a>';
                    $output .= '</li>';
                    break;
                case 'next':
                    $output .= '<li class="page-item page-item-' . $page_item_class . ' page-next' . $page_disabled_class . '">';
                    $output .= '<a aria-label="' . $page['text'] . '" class="page-link page-link-' . $page_link_class . ' page-link-next" href="' . $page['url'] . '">';
                    $output .= '<span aria-hidden="true">' . $page['text'] . '</span>';
                    if ($this->screen_reader) {
                        $output .= '<span class="sr-only">' . $page['text'] . '</span>';
                    }
                    $output .= '</a>';
                    $output .= '</li>';
                    break;
                case 'separator':
                    $output .= '<li class="page-item page-item-' . $page_item_class . ' disabled">';
                    $output .= '<span class="page-link">' . $page['text'] . '</span>';
                    if ($this->screen_reader) {
                        $output .= '<span class="sr-only">(separator)</span>';
                    }
                    $output .= '</li>';
                    break;
                case 'current':
                    $output .= '<li class="page-item page-item-' . $page_item_class . ' active">';
                    $output .= '<span class="page-link">' . $page['text'] . '</span>';
                    $output .= '</li>';
                    break;
                case 'page':
                    $output .= '<li class="page-item page-item-' . $page_item_class . '">';
                    $output .= '<a class="page-link page-link-' . $page_link_class . '" href="' . $page['url'] . '">' . $page['text'] . '</a>';
                    $output .= '</li>';
                    break;
            }

            $output .= "\r\n";
        }

        $output .= '</ul>';
        $output .= "\r\n";
        $output .= '</nav>';
        $output .= "\r\n";

        $this->pagination = $output;

        return $this->pagination;
    }

    /**
     * Generates the pagination structure and echoes to the output.
     *
     * @return void
     */
    public function output()
    {
        echo $this->get();
    }
}
