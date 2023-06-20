<?phpnamespace App;trait DynamicHiddenVisible {    public static $_hidden = null;    public static $_visible = null;    public static $_appends = null;    public static $_removeFromAppends = null;    public static function setStaticHidden(array $value) {        self::$_hidden = $value;        return self::$_hidden;    }    public static function getStaticHidden() {        return self::$_hidden;    }    public static function setStaticVisible(array $value) {        self::$_visible = $value;        return self::$_visible;    }    public static function getStaticVisible() {        return self::$_visible;    }    public static function getDefaultHidden() {        return with(new static)->getHidden();    }    public static function geDefaultVisible() {        return with(new static)->getVisible();    }    public static function getStaticAppends() {        return self::$_appends;    }    public static function getStaticRemoveAppends() {        return self::$_removeFromAppends;    }    public static function setStaticAppends(array $value) {        self::$_appends = $value;        return self::$_appends;    }    public static function removeStaticAppends(array $value) {        self::$_removeFromAppends = $value;        return self::$_removeFromAppends;    }    public static function getDefaultAppends() {        return with(new static)->getAppends();    }    public function getAppends(){        return $this->appends;    }    public function toArray()    {        if (self::getStaticVisible()){            $this->visible=array_merge(self::getStaticVisible(), $this->visible);        }else if (self::getStaticHidden()){            $this->hidden=array_merge(self::getStaticHidden(), $this->hidden);        }        if (self::getStaticAppends()) {            $this->appends = array_merge(self::getStaticAppends(), $this->appends);;        }        if (self::getStaticRemoveAppends()) {            $aa=$this->appends;            $aab=[];            foreach ($aa as $a){                if(!in_array($a,self::getStaticRemoveAppends())){                    $aab[]=$a;                }            }            $this->appends = $aab;        }        return parent::toArray();    }}