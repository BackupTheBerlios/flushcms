[?php use_helpers('I18N', 'Date') ?]

<?php if ($this->getParameterValue('list.tab_bar')): ?>
[?php include_partial('<?php echo $this->getModuleName() ?>/<?php echo $this->getParameterValue('list.tab_bar') ?>') ?]
<?php endif; ?>

<div id="sf_admin_container">

<h1><?php echo $this->getI18NString('list.title', $this->getModuleName().' list') ?></h1>

<?php if ($this->getParameterValue('list.search_form')): ?>
[?php include_partial('<?php echo $this->getModuleName() ?>/<?php echo $this->getParameterValue('list.search_form') ?>') ?]
<?php endif; ?>

<div id="sf_admin_header">
[?php include_partial('<?php echo $this->getModuleName() ?>/list_header') ?]
</div>

<div id="sf_admin_bar">

<?php //if ($this->getParameterValue('list.filters')): ?>
[?php //include_partial('filters', array('filters' => $filters)) ?]
<?php //endif; ?>

</div>

<div id="sf_admin_content">

[?php if(!$pager->getNbResults()): ?]
[?php echo __('no result') ?]
[?php else: ?]
<table cellspacing="0" class="sf_admin_list">
<thead>
<tr>
[?php include_partial('list_th_<?php echo $this->getParameterValue('list.layout', 'tabular') ?>') ?]
<?php if ($this->getParameterValue('list.object_actions')): ?>
  <th id="sf_admin_list_th_sf_actions">[?php echo __('Actions') ?]</th>
<?php endif; ?>
</tr>
</thead>
<tbody>
[?php $i = 1; foreach ($pager->getResults() as $<?php echo $this->getSingularName() ?>): $odd = fmod(++$i, 2) ?]
<tr class="sf_admin_row_[?php echo $odd ?]">
[?php include_partial('list_td_<?php echo $this->getParameterValue('list.layout', 'tabular') ?>', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
[?php include_partial('list_td_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
</tr>
[?php endforeach; ?]
</tbody>
<tfoot>
<tr><th colspan="<?php echo $this->getParameterValue('list.object_actions') ? count($this->getColumns('list.display')) + 1 : count($this->getColumns('list.display')) ?>">
<div class="float-right">
[?php if ($pager->haveToPaginate()): ?]
  [?php echo link_to(image_tag('/sf/images/sf_admin/first.png', array('align' => 'absmiddle', 'alt' => __('First'), 'title' => __('First'))), '<?php echo $this->getModuleName() ?>/list?page=1') ?]
  [?php echo link_to(image_tag('/sf/images/sf_admin/previous.png', array('align' => 'absmiddle', 'alt' => __('Previous'), 'title' => __('Previous'))), '<?php echo $this->getModuleName() ?>/list?page='.$pager->getPreviousPage()) ?]

  [?php foreach ($pager->getLinks() as $page): ?]
    [?php echo link_to_unless($page == $pager->getPage(), $page, '<?php echo $this->getModuleName() ?>/list?page='.$page) ?]
  [?php endforeach; ?]

  [?php echo link_to(image_tag('/sf/images/sf_admin/next.png', array('align' => 'absmiddle', 'alt' => __('Next'), 'title' => __('Next'))), '<?php echo $this->getModuleName() ?>/list?page='.$pager->getNextPage()) ?]
  [?php echo link_to(image_tag('/sf/images/sf_admin/last.png', array('align' => 'absmiddle', 'alt' => __('Last'), 'title' => __('Last'))), '<?php echo $this->getModuleName() ?>/list?page='.$pager->getLastPage()) ?]
[?php endif; ?]
</div>
[?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults()) ?]
</th></tr>
</tfoot>
</table>
[?php endif; ?]

[?php include_partial('list_actions') ?]

</div>

<div id="sf_admin_footer">
[?php include_partial('<?php echo $this->getModuleName() ?>/list_footer') ?]
</div>

</div>
