<?php
$unique_id = esc_attr( uniqid( 'search-term-creation-input--' ) );
?>

<div class="cp search-cp" data-name="Search">
    <div class="cr search---cr">
        <div class="hr search---hr">
            <div class="hr_cr search---hr_cr">
                <h2 class="h search---h"><span class="h_l search---h_l"><?php esc_html_e( 'Search', 'applicator'); ?></span></h2>
            </div>
        </div>
        <div class="ct search---ct">
            <div class="ct_cr search---ct_cr">
                <form class="form search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search" data-name="Search Form">
                    <div class="fieldsets search-form---fieldsets">
                        <div class="fieldsets---cr search-form---fieldsets---cr">

                            <div class="cp fs-item search-term-creation" data-name="Search Term Creation">
                                <div class="cr search-term-crt---cr">
                                    <div class="h search-term-crt---h"><span class="h_l search-term-crt---h_l"><?php esc_html_e( 'Search Term Creation', 'applicator'); ?></span></div>
                                    <div class="ct search-term-crt---ct">
                                        <div class="ct_cr search-term-crt---ct_cr">
                                            <span class="obj search-term-creation-label---obj" data-name="Search Term Creation Label">
                                                <label class="label search-term-crt-lbl---label" for="<?php echo $unique_id; ?>"><span class="label_l search-term-crt-lbl---label_l"><?php esc_html_e( 'Search Term', 'applicator'); ?></span></label>
                                            </span>
                                            <span class="obj search-term-creation-input---obj" data-name="Search Term Creation Input">
                                                <span class="ee--input-text search-term-crt-inp---ee--input-text"><input id="<?php echo $unique_id; ?>" class="input-text main-search-term-crt-inp--input-text" name="s" type="text" placeholder="<?php esc_attr_e( 'Enter search term', 'applicator' ); ?>" value="<?php echo get_search_query(); ?>" required></span>
                                            </span>
                                        </div>
                                    </div><!-- search-term-crt---ct -->
                                </div>
                            </div><!-- search-term-creation -->

                        </div>
                    </div><!-- fieldsets -->
                    <div class="axns main-search-form-axns" data-name="Search Form Actions">
                        <div class="cr main-search-form-axns---cr">
                            <div class="h main-search-form-axns---h"><span class="h_l main-search-form-axns---h_l">Search Form Actions</span></div>
                            <div class="ct main-search-form-axns---ct">
                                <div class="ct_cr main-search-form-axns---ct_cr">
                                    <div class="obj axn search-submit-axn" data-name="Search Submit Action">
                                        <button class="b search-submit-axn---b" type="submit" title="<?php esc_attr_e( 'Submit Search Term', 'applicator' ); ?>"><span class="b_l main-search-submit-axn---b_l"><span class="word search---word"><?php esc_html_e( 'Submit Search Term', 'applicator' ); ?></span></span></button>
                                    </div><!-- search-submit-axn -->
                                    <div class="obj axn search-reset-axn" data-name="Search Reset Action">
                                        <button class="b main-search-reset-axn---b" type="reset" title="<?php esc_attr_e( 'Reset Search Term', 'applicator' ); ?>"><span class="b_l main-search-reset-axn---b_l"><span class="word reset---word"><?php esc_html_e( 'Reset Search Term', 'applicator' ); ?></span></span></button>
                                    </div><!-- search-reset-axn -->
                                </div>
                            </div><!-- main-search-form-axns---ct -->
                        </div>
                    </div><!-- main-search-form-axns -->
                </form><!-- search-form -->
            </div>
        </div><!-- search---ct -->
    </div>
</div><!-- search-cp -->