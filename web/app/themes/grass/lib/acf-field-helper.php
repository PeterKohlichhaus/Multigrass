<?php

$connector = PhpConsole\Connector::getInstance();
$handler = PhpConsole\Handler::getInstance();
$handler->start();

class AcfHelper {
    private $closure;
    private $fields;
    private $layout;
    private $repeaterFieldName;
    private $fieldNames        = [];
    private $components        = [];
    private $fieldWrapElements = [];

    public function __construct(string ...$fieldNames) {
        $this->fieldNames = $fieldNames;
    }

    public function setClosure(Callable $closure) {
        $this->closure = $closure;
    }

    public function setComponents(array $components) {
        $this->components = $components;
    }

    public function setRepeaterFieldName(string $repeaterFieldName) {
        $this->repeaterFieldName = $repeaterFieldName;
    }

    public function setFieldWrapElements(array ...$fieldWrapElements) {
        $this->fieldWrapElements = $fieldWrapElements;
    }

    private function setFields()
    {
        foreach ($this->fieldNames as $fieldName) {
            if ($field = get_field($fieldName, null)) {
                $this->fields[$fieldName] = $field;
            } elseif ($subfield = get_sub_field($fieldName, null)) {
                $this->fields[$fieldName] = $subfield;
            }
        }
    }

    public function traverse() {
         // Create open tags around all fields

        //verify
        foreach ($this->fieldWrapElements as $fieldWrapElement) {
            echo '<' . $fieldWrapElement[0] . ' ' . $fieldWrapElement[1] . '>';
        }

        // Check if the repeater field name has been set
        if ($repeaterFieldName = $this->repeaterFieldName) {

            if (have_rows($this->repeaterFieldName)) {
                $page = null;
            } elseif (have_rows($this->repeaterFieldName, 'options')) {
                $page = 'options';
            }


            if (have_rows($this->repeaterFieldName, $page)) {
                $rowCount = 0;

                while (have_rows($this->repeaterFieldName, $page)) {
                    the_row();

                    $isTargetField = true;

                    // Check if the field is flexible content
                    if (get_row_layout()) {
                        $isTargetField = false;

                        // Check if the layout is the target layout
                        if ($this->layout === get_row_layout()) {
                            $isTargetField = true;
                        }
                    }

                    if ($isTargetField) {
                        if ($this->closure) {
                            $this->setFields();
                            $this->closure->call($this, $this->fields);
                        }
                    }

                    //create function
                    if ($this->components) {
                        foreach ($this->components as $component) {
                            $component->traverse();
                        }
                    }
                }
            }
        } else {
            $this->setFields();
            $this->closure->call($this, $this->fields);
            
            if ($this->components) {
                foreach ($this->components as $component) {
                    $component->traverse();
                }
            }
        }

        //verify
        // Create class tags around all fields
        foreach ($this->fieldWrapElements as $fieldWrapElement) {
            echo '</' . $fieldWrapElement[0] . '>';
        }
    }
}
