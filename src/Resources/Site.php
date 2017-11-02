<?php

namespace OhDear\PhpSdk\Resources;

class Site extends Resource
{
    /**
     * The id of the site.
     *
     * @var integer
     */
    public $id;

    /**
     * The url of the site.
     *
     * @var string
     */
    public $url;

    /**
     * The sort url of the site.
     *
     * @var string
     */
    public $sortUrl;

    /**
     * Delete the given site.
     *
     * @return void
     */
    public function delete()
    {
        $this->ohDear->deleteSite($this->serverId, $this->id);
    }

    /**
     * Install a git repository on the given site.
     *
     * @param  array $data
     * @return void
     */
    public function installGitRepository(array $data)
    {
        return $this->forge->installGitRepositoryOnSite($this->serverId, $this->id, $data);
    }

    /**
     * Update the site's git repository parameters.
     *
     * @param  array $data
     * @return void
     */
    public function updateGitRepository(array $data)
    {
        return $this->forge->updateSiteGitRepository($this->serverId, $this->id, $data);
    }

    /**
     * Destroy the git-based project installed on the site.
     *
     * @return void
     */
    public function destroyGitRepository()
    {
        return $this->forge->destroySiteGitRepository($this->serverId, $this->id);
    }

    /**
     * Get the content of the site's deployment script.
     *
     * @return string
     */
    public function getDeploymentScript()
    {
        return $this->forge->siteDeploymentLog($this->serverId, $this->id);
    }

    /**
     * Update the content of the site's deployment script.
     *
     * @param  string $content
     * @return void
     */
    public function updateDeploymentScript($content)
    {
        return $this->forge->updateSiteDeploymentScript($this->serverId, $this->id, $content);
    }

    /**
     * Enable "Quick Deploy" for the given site.
     *
     * @return void
     */
    public function enableQuickDeploy()
    {
        return $this->forge->enableQuickDeploy($this->serverId, $this->id);
    }

    /**
     * Disable "Quick Deploy" for the given site.
     *
     * @return void
     */
    public function disableQuickDeploy()
    {
        return $this->forge->disableQuickDeploy($this->serverId, $this->id);
    }

    /**
     * Deploy the given site.
     *
     * @return void
     */
    public function deploySite()
    {
        return $this->forge->deploySite($this->serverId, $this->id);
    }

    /**
     * Enable Hipchat Notifications for the given site.
     *
     * @param  array $data
     * @return void
     */
    public function enableHipchatNotifications(array $data)
    {
        return $this->forge->enableHipchatNotifications($this->serverId, $this->id, $data);
    }

    /**
     * Disable Hipchat Notifications for the given site.
     *
     * @return void
     */
    public function disableHipchatNotifications()
    {
        return $this->forge->disableHipchatNotifications($this->serverId, $this->id);
    }

    /**
     * Install a new WordPress project.
     *
     * @return void
     */
    public function installWordPress($data)
    {
        return $this->forge->installWordPress($this->serverId, $this->id, $data);
    }

    /**
     * Remove the WordPress project installed on the site.
     *
     * @return void
     */
    public function removeWordPress()
    {
        return $this->forge->removeWordPress($this->serverId, $this->id);
    }
}

