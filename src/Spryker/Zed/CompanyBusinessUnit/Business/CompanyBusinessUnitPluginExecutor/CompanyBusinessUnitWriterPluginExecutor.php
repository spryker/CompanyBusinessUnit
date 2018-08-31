<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitPluginExecutor;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

class CompanyBusinessUnitWriterPluginExecutor implements CompanyBusinessUnitWriterPluginExecutorInterface
{
    /**
     * @var \Spryker\Zed\CompanyBusinessUnitExtension\Dependency\Plugin\CompanyBusinessUnitPostSavePluginInterface[]
     */
    protected $companyBusinessUnitPostSavePlugins;

    /**
     * @var array
     */
    protected $companyBusinessUnitPreDeletePlugins;

    /**
     * @param \Spryker\Zed\CompanyBusinessUnitExtension\Dependency\Plugin\CompanyBusinessUnitPostSavePluginInterface[] $companyBusinessUnitPostSavePlugins
     * @param \Spryker\Zed\CompanyBusinessUnitExtension\Dependency\Plugin\CompanyBusinessUnitPreDeletePluginInterface[] $companyBusinessUnitPreDeletePlugins
     */
    public function __construct(array $companyBusinessUnitPostSavePlugins, array $companyBusinessUnitPreDeletePlugins)
    {
        $this->companyBusinessUnitPostSavePlugins = $companyBusinessUnitPostSavePlugins;
        $this->companyBusinessUnitPreDeletePlugins = $companyBusinessUnitPreDeletePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    public function executePostSavePlugins(CompanyBusinessUnitTransfer $companyBusinessUnitTransfer): CompanyBusinessUnitTransfer
    {
        foreach ($this->companyBusinessUnitPostSavePlugins as $plugin) {
            $companyBusinessUnitTransfer = $plugin->postSave($companyBusinessUnitTransfer);
        }

        return $companyBusinessUnitTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    public function executePreDeletePlugins(CompanyBusinessUnitTransfer $companyBusinessUnitTransfer): CompanyBusinessUnitTransfer
    {
        foreach ($this->companyBusinessUnitPreDeletePlugins as $plugin) {
            $companyBusinessUnitTransfer = $plugin->preDelete($companyBusinessUnitTransfer);
        }

        return $companyBusinessUnitTransfer;
    }
}
