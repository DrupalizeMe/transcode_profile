<?php

/**
 * @file
 * Contains \Drupal\Console\Command\Module\DebugCommand.
 */

namespace Drupal\Console\Command\Module;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Drupal\Console\Command\ContainerAwareCommand;

class DebugCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('module:debug')
            ->setDescription($this->trans('commands.module.debug.description'))
            ->addOption('status', null, InputOption::VALUE_OPTIONAL, $this->trans('commands.module.debug.options.status'))
            ->addOption('type', null, InputOption::VALUE_OPTIONAL, $this->trans('commands.module.debug.options.type'));
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $status = $input->getOption('status');
        $type = $input->getOption('type');

        if (strtolower($status) == 'enabled') {
            $status = 1;
        } elseif (strtolower($status) == 'disabled') {
            $status = 0;
        } else {
            $status = -1;
        }

        if (strtolower($type) == 'core') {
            $type = 'core';
        } elseif (strtolower($type) == 'no-core') {
            $type = '';
        } else {
            $type = null;
        }

        $table = $this->getTableHelper();
        $table->setlayout($table::LAYOUT_COMPACT);
        $this->getAllModules($status, $type, $output, $table);
    }

    protected function getAllModules($status, $type, $output, $table)
    {
        $this->getDrupalHelper()->loadLegacyFile('/core/includes/schema.inc');

        $table->setHeaders(
            [
                $this->trans('commands.module.debug.messages.id'),
                $this->trans('commands.module.debug.messages.name'),
                $this->trans('commands.module.debug.messages.status'),
                $this->trans('commands.module.debug.messages.package'),
                $this->trans('commands.module.debug.messages.schema-version'),
                $this->trans('commands.module.debug.messages.origin'),
            ]
        );

        $table->setlayout($table::LAYOUT_COMPACT);

        $modules = system_rebuild_module_data();
        foreach ($modules as $module_id => $module) {
            if ($status >= 0 && $status != $module->status) {
                continue;
            }

            if ($type !== null && $type !== $module->origin) {
                continue;
            }

            $module_status = ($module->status) ? $this->trans('commands.module.debug.messages.enabled') : $this->trans('commands.module.debug.messages.disabled');

            $schema_version = (drupal_get_installed_schema_version($module_id)!= -1?drupal_get_installed_schema_version($module_id): '');
            $table->addRow(
                [
                    $module_id,
                    $module->info['name'],
                    $module_status,
                    $module->info['package'],
                    $schema_version,
                    $module->origin,
                ]
            );
        }

        $table->render($output);
    }
}
