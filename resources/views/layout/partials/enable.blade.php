<div class="Polaris-Box" style="--pc-box-background:var(--p-color-bg);--pc-box-border-radius:var(--p-border-radius-2);--pc-box-overflow-x:hidden;--pc-box-overflow-y:hidden;--pc-box-padding-block-end-xs:var(--p-space-4);--pc-box-padding-block-end-sm:var(--p-space-5);--pc-box-padding-block-start-xs:var(--p-space-4);--pc-box-padding-block-start-sm:var(--p-space-5);--pc-box-padding-inline-start-xs:var(--p-space-4);--pc-box-padding-inline-start-sm:var(--p-space-5);--pc-box-padding-inline-end-xs:var(--p-space-4);--pc-box-padding-inline-end-sm:var(--p-space-5);--pc-box-shadow:var(--p-shadow-md)">
  <div class="Polaris-VerticalStack" style="--pc-vertical-stack-order:column;--pc-vertical-stack-gap-xs:var(--p-space-4);--pc-vertical-stack-gap-sm:var(--p-space-5)">
    <div class="Polaris-Box" style="--pc-box-width:100%">
      <div class="Polaris-VerticalStack" style="--pc-vertical-stack-order:column;--pc-vertical-stack-gap-xs:var(--p-space-2);--pc-vertical-stack-gap-sm:var(--p-space-4)">
        <div class="Polaris-Box mt-2" style="--pc-box-width:100%">
          <div class="Polaris-HorizontalStack" style="--pc-horizontal-stack-align:space-between;--pc-horizontal-stack-block-align:start;--pc-horizontal-stack-wrap:nowrap;--pc-horizontal-stack-gap-xs:var(--p-space-12)">
            <div class="Polaris-HorizontalStack" style="--pc-horizontal-stack-wrap:nowrap;--pc-horizontal-stack-gap-xs:var(--p-space-2)">
              <div class="Polaris-HorizontalStack" style="--pc-horizontal-stack-align:start;--pc-horizontal-stack-block-align:baseline;--pc-horizontal-stack-wrap:wrap;--pc-horizontal-stack-gap-xs:var(--p-space-2)">
                <label for="setting-toggle-uuid">
                  <h6 class="Polaris-Text--root Polaris-Text--headingMd">Enable App</h6>
                </label>
                <div class="Polaris-HorizontalStack" style="--pc-horizontal-stack-align:center;--pc-horizontal-stack-block-align:center;--pc-horizontal-stack-wrap:wrap;--pc-horizontal-stack-gap-xs:var(--p-space-2)">
                                      <span class="Polaris-Badge @if($configuration->is_enabled == 1) Polaris-Badge--statusSuccess @else Polaris-Badge--statusAttention @endif" >
                                        <span class="Polaris-Text--root Polaris-Text--bodySm">@if($configuration !=null) @if($configuration->is_enabled == 1) On @else Off @endif @endif</span>
                                      </span>
                </div>
              </div>
            </div>
            <div class="Polaris-Box" style="--pc-box-min-width:fit-content">
              <div class="Polaris-HorizontalStack" style="--pc-horizontal-stack-align:end;--pc-horizontal-stack-wrap:wrap">
                <label class="ui-switch mb-0" style="align-items: center;">
                  <label class="mr-4 mb-0"></label>
                  <input id="is_enabled" value="@if($configuration != null) @if($configuration->is_enabled == 1) 1 @else 0 @endif @endif" type="checkbox"
                         @if($configuration != null )
                           @if($configuration->is_enabled == 1)
                             checked="checked"
                         @endif
                         @endif name="is_enabled">
                  <span></span>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>