{*
* @author    SpecialDev
* @copyright SpecialDev 2017
* @license  SpecialDev
* @version 1.0
* @category administration
*}

<script type="text/javascript">
    var checkAll_label = '{l s='Check all' mod='sdboost' js=1}';
    var uncheckAll_label = '{l s='Uncheck all' mod='sdboost' js=1}';
    var row = '{l s='record.' mod='sdboost' js=1}';
    var rows = '{l s='records.' mod='sdboost' js=1}';
    var ajax_url = "{$module_dir|escape:'htmlall':'UTF-8'}ajax.php";
    var ajaxdb_url = "{$module_dir|escape:'htmlall':'UTF-8'}ajaxdb.php";
</script>

<div class='col-lg-12' id="sdboost">
	<form method='post' class='form-horizontal' name='menu'>
        <div class="alert alert-warning">{l s='It is recommended to make a backup of the database and activate maintenance mode.' mod='sdboost'}</div>
        <div class='panel'>
            <h3>{l s='PrestaShop Booster' mod='sdboost'}</h3>
            <div class='form-group'>
                <label class="control-label col-lg-2" style="padding-top:0px;">
                    {l s='Data Base size' mod='sdboost'}:
                </label>
                <div class='col-lg-4' >
                    <strong>{$size_db|escape:'htmlall':'UTF-8'}</strong>
                </div>
            </div>
            <div class='form-group'>
                <div class='col-lg-2' style="text-align:right;">
                    <input type='checkbox' name='ps_cart' id='ps_cart' />
                </div>
                <label class="control-label col-lg-10" for="ps_cart" style="text-align:left;padding-top:0px;">
                    {l s='Delete unnecessary carts.' mod='sdboost'}<span class="{if $sql_cart >0}rework{else}norework{/if}"> ({$sql_cart|escape:'htmlall':'UTF-8'} {if $sql_cart == 1}{l s='record.' mod='sdboost'}{else}{l s='records.' mod='sdboost'}{/if})</span></p>
                </label>
            </div>
            <div class='form-group'>
                <div class='col-lg-2' style="text-align:right;">
                    <input type='checkbox' name='ps_specific_price' id='ps_specific_price'/>
                </div>
                <label class="control-label col-lg-10" for="ps_specific_price" style="text-align:left;padding-top:0px;">
                    {l s='Delete old discounts on products.' mod='sdboost'}<span class="{if $sql_specific_price >0}rework{else}norework{/if}"> ({$sql_specific_price|escape:'htmlall':'UTF-8'} {if $sql_specific_price == 1}{l s='record.' mod='sdboost'}{else}{l s='records.' mod='sdboost'}{/if})</span>
                </label>
            </div>
            <div class='form-group'>
                <div class='col-lg-2' style="text-align:right;">
                    <input type='checkbox' name='ps_page_viewed' id='ps_page_viewed'/>
                </div>
                <label class="control-label col-lg-10" for="ps_page_viewed" style="text-align:left;padding-top:0px;">
                    {l s='Delete data about visited pages of the website.' mod='sdboost'}<span class="{if $sql_page_viewed >0}rework{else}norework{/if}"> ({$sql_page_viewed|escape:'htmlall':'UTF-8'} {if $sql_page_viewed == 1}{l s='record.' mod='sdboost'}{else}{l s='records.' mod='sdboost'}{/if})</span>
                </label>
            </div>
            <hr>
            <div class='form-group'>
                <div class='col-lg-2' style="text-align:right;">
                    <input type='checkbox' name='ps_connections' id='ps_connections'/>
                </div>
                <label class="control-label col-lg-10" for="ps_connections" style="text-align:left;padding-top:0px;">
                    {l s='Remove unnecessary data about IP addresses of visitors, referrers and visited pages.' mod='sdboost'}<span class="{if $sql_connections >0}rework{else}norework{/if}"> ({$sql_connections|escape:'htmlall':'UTF-8'} {if $sql_connections == 1}{l s='record.' mod='sdboost'}{else}{l s='records.' mod='sdboost'}{/if})</span>
                </label>
            </div>
            <div class='form-group'>
                <div class='col-lg-2' style="text-align:right;">
                    <input type='checkbox' name='ps_connections_page' id='ps_connections_page'/>
                </div>
                <label class="control-label col-lg-10" for="ps_connections_page" style="text-align:left;padding-top:0px;">
                    {l s='Remove unnecessary data about start and end hours of page views.' mod='sdboost'}<span class="{if $sql_connections_page >0}rework{else}norework{/if}"> ({$sql_connections_page|escape:'htmlall':'UTF-8'} {if $sql_connections_page == 1}{l s='record.' mod='sdboost'}{else}{l s='records.' mod='sdboost'}{/if})</span></p>	
                </label>
            </div>
            <div class='form-group'>
                <div class='col-lg-2' style="text-align:right;">
                    <input type='checkbox' name='ps_connections_source' id='ps_connections_source'/>
                </div>
                <label class="control-label col-lg-10" for="ps_connections_source" style="text-align:left;padding-top:0px;">
                    {l s='Remove unnecessary data concerning keywords search engine and visitors.' mod='sdboost'}<span class="{if $sql_connections_source >0}rework{else}norework{/if}"> ({$sql_connections_source|escape:'htmlall':'UTF-8'} {if $sql_connections_source == 1}{l s='record.' mod='sdboost'}{else}{l s='records.' mod='sdboost'}{/if})</span>
                </label>
            </div>
            <div class='form-group'>
                <div class='col-lg-2' style="text-align:right;">
                    <input type='checkbox' name='ps_guest' id='ps_guest'/>
                </div>
                <label class="control-label col-lg-10" for="ps_guest" style="text-align:left;padding-top:0px;">
                    {l s='Remove unnecessary data concerning vistors operating system, browser, screen resolution ...' mod='sdboost'}<span class="{if $sql_guest >0}rework{else}norework{/if}"> ({$sql_guest|escape:'htmlall':'UTF-8'} {if $sql_guest == 1}{l s='record.' mod='sdboost'}{else}{l s='records.' mod='sdboost'}{/if})</span></p>
                </label>
            </div>
            <div class='form-group'>
                <div class='col-lg-2' style="text-align:right;">
                    <input type='checkbox' name='ps_pagenotfound' id='ps_pagenotfound' />
                </div>
                <label class="control-label col-lg-10" for="ps_pagenotfound" style="text-align:left;padding-top:0px;">
                    {l s='Remove data about not found pages.' mod='sdboost'}<span class="{if $sql_pagenotfound >0}rework{else}norework{/if}"> ({$sql_pagenotfound|escape:'htmlall':'UTF-8'} {if $sql_pagenotfound == 1}{l s='record.' mod='sdboost'}{else}{l s='records.' mod='sdboost'}{/if})</span></p>
                </label>
            </div>
            <div id="datainfo">{l s='Old database size' mod='sdboost'}:<strong> {$size_db|escape:'htmlall':'UTF-8'}</strong> / {l s='New database size' mod='sdboost'}:<span class="sizenow"> ...</span></div>
            <div class="panel-footer">
                <a id="boost_me" class='btn btn-success pull-right' name='update_data'><i class="icon icon-clock-o" aria-hidden="true"></i> {l s='Boost' mod='sdboost'}<a/>
                <a id="refresh" class='btn pull-right btn-warning' name='update_data'><i class="icon icon-refresh" aria-hidden="true"></i> {l s='Refresh' mod='sdboost'}<a/>
                <a id="all_selected" class="btn btn-default pull-right"><i class="icon icon-check-circle-o" aria-hidden="true"></i> {l s='Check all' mod='sdboost'}</a>
            </div>
        </div>
    </form>
</div>