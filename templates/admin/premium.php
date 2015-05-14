<style>
    .section{
        margin-left: -20px;
        margin-right: -20px;
        font-family: "Raleway",san-serif;
    }
    .section h1{
        text-align: center;
        text-transform: uppercase;
        color: #808a97;
        font-size: 35px;
        font-weight: 700;
        line-height: normal;
        display: inline-block;
        width: 100%;
        margin: 50px 0 0;
    }
    .section:nth-child(even){
        background-color: #fff;
    }
    .section:nth-child(odd){
        background-color: #f1f1f1;
    }
    .section .section-title img{
        display: table-cell;
        vertical-align: middle;
        width: auto;
        margin-right: 15px;
    }
    .section h2,
    .section h3 {
        display: inline-block;
        vertical-align: middle;
        padding: 0;
        font-size: 24px;
        font-weight: 700;
        color: #808a97;
        text-transform: uppercase;
    }

    .section .section-title h2{
        display: table-cell;
        vertical-align: middle;
    }

    .section-title{
        display: table;
    }

    .section h3 {
        font-size: 14px;
        line-height: 28px;
        margin-bottom: 0;
        display: block;
    }

    .section p{
        font-size: 13px;
        margin: 25px 0;
    }
    .section ul li{
        margin-bottom: 4px;
    }
    .landing-container{
        max-width: 750px;
        margin-left: auto;
        margin-right: auto;
        padding: 50px 0 30px;
    }
    .landing-container:after{
        display: block;
        clear: both;
        content: '';
    }
    .landing-container .col-1,
    .landing-container .col-2{
        float: left;
        box-sizing: border-box;
        padding: 0 15px;
    }
    .landing-container .col-1 img{
        width: 100%;
    }
    .landing-container .col-1{
        width: 55%;
    }
    .landing-container .col-2{
        width: 45%;
    }
    .premium-cta{
        background-color: #808a97;
        color: #fff;
        border-radius: 6px;
        padding: 20px 15px;
    }
    .premium-cta:after{
        content: '';
        display: block;
        clear: both;
    }
    .premium-cta p{
        margin: 7px 0;
        font-size: 14px;
        font-weight: 500;
        display: inline-block;
        width: 60%;
    }
    .premium-cta a.button{
        border-radius: 6px;
        height: 60px;
        float: right;
        background: url(<?php echo YITH_YWRAQ_URL?>assets/images/upgrade.png) #ff643f no-repeat 13px 13px;
        border-color: #ff643f;
        box-shadow: none;
        outline: none;
        color: #fff;
        position: relative;
        padding: 9px 50px 9px 70px;
    }
    .premium-cta a.button:hover,
    .premium-cta a.button:active,
    .premium-cta a.button:focus{
        color: #fff;
        background: url(<?php echo YITH_YWRAQ_URL?>assets/images/upgrade.png) #971d00 no-repeat 13px 13px;
        border-color: #971d00;
        box-shadow: none;
        outline: none;
    }
    .premium-cta a.button:focus{
        top: 1px;
    }
    .premium-cta a.button span{
        line-height: 13px;
    }
    .premium-cta a.button .highlight{
        display: block;
        font-size: 20px;
        font-weight: 700;
        line-height: 20px;
    }
    .premium-cta .highlight{
        text-transform: uppercase;
        background: none;
        font-weight: 800;
        color: #fff;
    }

    @media (max-width: 768px) {
        .section{margin: 0}
        .premium-cta p{
            width: 100%;
        }
        .premium-cta{
            text-align: center;
        }
        .premium-cta a.button{
            float: none;
        }
    }

    @media (max-width: 480px){
        .wrap{
            margin-right: 0;
        }
        .section{
            margin: 0;
        }
        .landing-container .col-1,
        .landing-container .col-2{
            width: 100%;
            padding: 0 15px;
        }
        .section-odd .col-1 {
            float: left;
            margin-right: -100%;
        }
        .section-odd .col-2 {
            float: right;
            margin-top: 65%;
        }
    }

    @media (max-width: 320px){
        .premium-cta a.button{
            padding: 9px 20px 9px 70px;
        }

        .section .section-title img{
            display: none;
        }
    }
</style>
<div class="landing">
    <div class="section section-cta section-odd">
        <div class="landing-container">
            <div class="premium-cta">
                <p>
                    Upgrade to the <span class="highlight">premium version</span>
                    of <span class="highlight">YITH WooCommerce Request a Quote</span> to benefit from all features!
                </p>
                <a href="<?php echo YITH_YWRAQ_Admin()->get_premium_landing_uri() ?>" target="_blank" class="premium-cta-button button btn">
                    <span class="highlight">UPGRADE</span>
                    <span>to the premium version</span>
                </a>
            </div>

        </div>
    </div>
    <div class="section section-even clear" style="background: url(<?php echo YITH_YWRAQ_URL ?>assets/images/01-bg.png) no-repeat #fff; background-position: 85% 75%">
        <h1>Premium Features</h1>
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YWRAQ_URL ?>assets/images/01.png" alt="Review Title" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWRAQ_URL ?>assets/images/01-icon.png" alt="Review Title"/>
                    <h2>CUSTOMISED BUTTON</h2>
                </div>
                <p>Choose the style you prefer for your <b>“Add to Quote”</b> button! In the plugin option panel users will be
                    able to find a section to set colours and text for the button.
                </p>
            </div>
        </div>
    </div>
    <div class="section section-odd clear" style="background: url(<?php echo YITH_YWRAQ_URL ?>assets/images/02-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWRAQ_URL ?>assets/images/02-icon.png" alt="Attachment List" />
                    <h2>NOT JUST IN PRODUCT PAGE</h2>
                </div>
                <p>Give users the opportunity to add one or more products to their list for a quote request from many
                    different pages in your shop, and <b>not just from product detail page</b>. Enable this option and the
                    button will be shown also in other pages of your store.</p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YWRAQ_URL ?>assets/images/02.png" alt="Attachment List" />
            </div>
        </div>
    </div>
    <div class="section section-even clear" style="background: url(<?php echo YITH_YWRAQ_URL ?>assets/images/03-bg.png) no-repeat #fff; background-position: 85% 100%">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YWRAQ_URL ?>assets/images/03.png" alt="Vote the review" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWRAQ_URL ?>assets/images/03-icon.png" alt="Vote the review" />
                    <h2>HIDE PRODUCT PRICE</h2>
                </div>
                <p>Put you do not want to show price for products in your shop. Just a click and your wish comes true. Enable the option “Hide Price” and it’s done!</p>
            </div>
        </div>
    </div>
    <div class="section section-odd clear" style="background: url(<?php echo YITH_YWRAQ_URL ?>assets/images/04-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWRAQ_URL ?>assets/images/04-icon.png" alt="Number" />
                    <h2>EXCLUSION TABLE</h2>
                </div>
                <p>A dedicated list where you can add those products that have to be excluded from quote requests.
                    Enable the specific option and “Add to Quote” button will <b>not be displayed</b> for products in this
                    table. </p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YWRAQ_URL ?>assets/images/04.png" alt="Number" />
            </div>
        </div>
    </div>
    <div class="section section-even clear" style="background: url(<?php echo YITH_YWRAQ_URL ?>assets/images/05-bg.png) no-repeat #fff; background-position: 85% 100%">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YWRAQ_URL ?>assets/images/05.png" alt="Filter by rating" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWRAQ_URL?>assets/images/05-icon.png" alt="Filter by rating" />
                    <h2>USER FILTERS</h2>
                </div>
                <p>A specific option allows you to filter users to which applying plugin features. You can choose among
                    <b>registered</b> users, <b>unregistered</b> ones or let the plugin work for all of them without making any
                    distinction. </p>
            </div>
        </div>
    </div>
    <div class="section section-odd clear" style="background: url(<?php echo YITH_YWRAQ_URL ?>assets/images/06-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWRAQ_URL ?>assets/images/06-icon.png" alt="Number" />
                    <h2>REQUEST FORM</h2>
                </div>
                <p>The plugin includes a default form for <b>sending emails</b>, but if you feel you’re not satisfied by the
                    form you find there, you can enjoy creating your contact form using “Contact Form 7” and “YITH
                    Contact Form”. Two external plugins that, once correctly set, work perfectly to improve your plugin
                    features.</p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YWRAQ_URL ?>assets/images/04.png" alt="Number" />
            </div>
        </div>
    </div>
    <div class="section section-even clear" style="background: url(<?php echo YITH_YWRAQ_URL ?>assets/images/07-bg.png) no-repeat #fff; background-position: 85% 100%">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YWRAQ_URL ?>assets/images/07.png" alt="Filter by rating" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWRAQ_URL?>assets/images/07-icon.png" alt="Filter by rating" />
                    <h2>REQUEST MANAGEMENT</h2>
                </div>
                <p>Every request you get is treated like an order! Yes, that’s it. As soon as a user sends a quote request, you will see it in WooCommerce “Orders” section.
                    <b>Many details for each request</b>, from current status to the username that generated it.
                    A rich page specifically created to have everything there and at a hand’s grasp.
                </p>
            </div>
        </div>
    </div>
    <div class="section section-odd clear" style="background: url(<?php echo YITH_YWRAQ_URL ?>assets/images/08-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWRAQ_URL ?>assets/images/08-icon.png" alt="Number" />
                    <h2> SEND THE QUOTE</h2>
                </div>
                <p>The best of interaction with your users. They send their request and you can answer so simply, just
                    need to access your admin panel. A few steps to send the right proposal that <b>persuades</b> your customer
                    to purchase.</p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YWRAQ_URL ?>assets/images/08.png" alt="Number" />
            </div>
        </div>
    </div>
    <div class="section section-even clear" style="background: url(<?php echo YITH_YWRAQ_URL ?>assets/images/09-bg.png) no-repeat #fff; background-position: 85% 100%">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YWRAQ_URL ?>assets/images/09.png" alt="Filter by rating" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWRAQ_URL?>assets/images/09-icon.png" alt="Filter by rating" />
                    <h2>ACCEPT OR REJECT?</h2>
                </div>
                <p>Users can decide whether to <b>accept</b> or <b>reject</b> your quote proposal directly from the email they’ve got.
                    Two simple choice options, that show professionalism and that your users will certainly appreciate.
                    In case they accept, they will be redirected to the order checkout.
                </p>
            </div>
        </div>
    </div>
    <div class="section section-odd clear" style="background: url(<?php echo YITH_YWRAQ_URL ?>assets/images/10-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWRAQ_URL ?>assets/images/10-icon.png" alt="Number" />
                    <h2> A QUOTE WITH EXPIRATION</h2>
                </div>
                <p>You made a good offer, one that cannot be rejected, and you want to urge your customer to purchase by
                    <b>setting an expiration date for the proposal you are offering?</b> Add the expiration date directly from
                    the request page while you are writing your undeniable proposal.
                </p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YWRAQ_URL ?>assets/images/10.png" alt="Number" />
            </div>
        </div>
    </div>
    <div class="section section-even clear" style="background: url(<?php echo YITH_YWRAQ_URL ?>assets/images/11-bg.png) no-repeat #fff; background-position: 85% 100%">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YWRAQ_URL ?>assets/images/11.png" alt="Filter by rating" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWRAQ_URL?>assets/images/11-icon.png" alt="Filter by rating" />
                    <h2>Recent requests in “My Account”</h2>
                </div>
                <p>All users registered in your store can see all quote requests they have sent from <b>“My Account”</b> page and check details, included the current status for them. </p>
            </div>
        </div>
    </div>
    <div class="section section-odd clear" style="background: url(<?php echo YITH_YWRAQ_URL ?>assets/images/12-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWRAQ_URL ?>assets/images/12-icon.png" alt="Number" />
                    <h2>Widget</h2>
                </div>
                <p>Add a wigdet in the sidebar of your shop and put it at your customers’ disposal. There they will see a <b>list</b> with all products they have selected and added to the quote request so far. </p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YWRAQ_URL ?>assets/images/12.png" alt="Number" />
            </div>
        </div>
    </div>
    <div class="section section-cta section-odd">
        <div class="landing-container">
            <div class="premium-cta">
                <p>
                    Upgrade to the <span class="highlight">premium version</span>
                    of <span class="highlight">YITH WooCommerce Request a Quote</span> to benefit from all features!
                </p>
                <a href="<?php echo YITH_YWRAQ_Admin()->get_premium_landing_uri() ?>" target="_blank" class="premium-cta-button button btn">
                    <span class="highlight">UPGRADE</span>
                    <span>to the premium version</span>
                </a>
            </div>
        </div>
    </div>
</div>