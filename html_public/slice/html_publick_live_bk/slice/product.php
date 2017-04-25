<?php include_once('_header.php'); ?>

<div id="content">
    <div class="product-page">
        <div class="text_intro"><a href="#">Back to iPhone / iPad Stands</a></div>

        <div class="product-wrap">
            <?php if(is_mobile()):
                include_once('mobile_product_inner.php');
            else:
                include_once('product_inner.php');
            endif;
            ?>
        </div>
    </div>  <!-- .product-page -->
</div><!-- #content -->

<div class="modal" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <div class="modal-body">
        <form id="quote-form" class="form-horizontal">
            <h2 class="dinpro">Instant Quote</h2>
            <div class="control-group">
                <label class="control-label" for="name_first1">Name:</label>
                <div class="controls">
                    <input class="input-small first" type="text" id="name_first1" placeholder="First">
                    <input class="input-small" type="text" id="name_last1" placeholder="Last">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="company1">Company:</label>
                <div class="controls">
                    <input type="text" id="company1" placeholder="">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="email1">Email:</label>
                <div class="controls">
                    <input type="text" id="email1" placeholder="">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="phone1">Phone Number:</label>
                <div class="controls">
                    <input type="text" id="phone1" placeholder="">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="model">Product Model:</label>
                <div class="controls">
                    <input type="text" id="model" placeholder="">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="rush">Rush Production:</label>
                <div class="controls">
                    <select id="rush" name="rush" tabindex="1">
                        <option value="0">Please select desired rush production option.</option>
                        <option value="1">3 Business Day Rush Service</option>
                        <option value="2">7 Business Day Rush Service</option>
                    </select>
                </div>
            </div>
            <div class="control-group newsletter">
                <label class="control-label">Logistics Fulfillment:</label>
                <div class="controls">
                    Qpromo's fulfillment solution manages the shipping process of your promotional products directly to your customers.
                    <a href="#" class="subscribe">Interested</a><a href="#" class="subscribe_no">No, Thank you.</a>
                </div>
            </div>

            <div class="control-group membership">
                <label class="control-label" for="membership">Membership #:</label>
                <div class="controls">
                    <input type="text" id="membership" placeholder="">
                    <span class="help-block">e.g. ASI // PPAI // PPAC // SAGE#</span>
                </div>
            </div>


            <div class="control-group message">
                <label class="control-label" for="comment">Message:</label>
                <div class="controls">
                    <textarea id="comment" name="comment" placeholder="Please write us any comments."></textarea>
                </div>
            </div>

            <div class="control-group buttons">
                <div class="controls">
                    <span>A Qpromo representative will contact you in 1-2 business days.</span>
                    <button id="submit" type="submit" class="btn">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include_once('_footer.php'); ?>